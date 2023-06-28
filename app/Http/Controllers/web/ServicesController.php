<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\ServiceInfo;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\ContactInfo;
use App\Models\Agents;
use App\Models\HeroBanner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
      $item = new \stdClass();
      if(app()->getLocale()=="en")
     {
      $item->MetaTitle="Real estate investment agents and specialists in legal and design matters";
      $item->MetaDescription="Homes has specialized agents for property marketing. We partner with industry specialists for legal and architectural advice for real estate investments";
      $items = Services::where('IsEnable', 1)->get(['Slug','Guid','Title','Title AS LinkTitle','Description','Image','CreatedDate']);
     }else{
        $items = Services::where('IsEnable', 1)->get(['SlugAr AS Slug','Guid','TitleAr AS Title','Title AS LinkTitle','DescriptionAr AS Description','Image','CreatedDate']);
        $item->MetaTitle="خبراء الاستثمار العقاري واستشاريون في الأمور القانونية العقارية  و الهندسية ";
        $item->MetaDescription="هومز لديها مستشارون متخصصون لتسويق العقارات. بالتشارك مع شركات متخصصة  لتقديم المشورة القانونية والمعمارية لمساعدة العميل في اتخاذ قرار الاستثمارا العقاري";
     }
     $meta="pages";
    // $items->hero_banner=HeroBanner::where('id',4)->value('Image');
    return view('web-layouts.services.service-list',compact('items','item','meta'));
    }
    public function servicesDetails($Lang=null,$Slug)
    {   
      $Slug=urldecode($Slug);
      if(app()->getLocale()=="en")
      {
         $item = Services::where('Slug', $Slug)->where('IsEnable', 1)->first(['Guid','Title','Description','MetaTitle','MetaDescription','Image','CreatedDate']);
         $servicesLimits = Services::where('Slug','!=',$Slug)->where('IsEnable', 1)->orderBy('created_at', 'ASC')->take(5)->get(['Slug','Guid','Title','Title  AS LinkTitle','Description','Image','CreatedDate']);
         $Agents=Agents::where('IsEnable',1)
         ->get(['DisplayName','DisplayEmail','DisplayPhone','DisplayPhoto','PropertyType']);
      }else{
        $item = Services::where('SlugAr', $Slug)->where('IsEnable', 1)->first(['Guid','TitleAr AS Title','DescriptionAr AS Description','MetaTitleAr AS MetaTitle','MetaDescriptionAr AS MetaDescription','Image','CreatedDate']);
        $servicesLimits = Services::where('SlugAr','!=',$Slug)->where('IsEnable', 1)->orderBy('created_at', 'ASC')->take(5)->get(['SlugAr AS Slug','Guid','Title  AS LinkTitle','TitleAr AS Title','DescriptionAr AS Description','Image','CreatedDate']);
        $Agents=Agents::select(['a.DisplayNameAr AS DisplayName','a.DisplayEmail','a.DisplayPhone','a.DisplayPhoto','PropertyType'])
        ->from('propety_agents as a')
        ->where('a.IsEnable',1)
        ->get();
        }
        $meta='service';
        if($item)
        {
          return view('web-layouts.services.services-details', compact('item','servicesLimits','Agents','meta'));
        }else{
          //return view('web-layouts.services.404');
          return redirect()->route('home');
        }
        //$item->hero_banner=HeroBanner::where('id',5)->first(['Image','Alt']);
       
    }

    public function createEnquiry(Request $request)
    {
      $request->validate([

        'Name' => 'required',
        //'Email' => 'required',
        'Phone' => 'required',
        //'Message' => 'required',
        'ServiceID'=>'required',
        'g-recaptcha-response' => 'recaptcha',
      ],[
        'g-recaptcha-response.recaptcha' => 'Invalid recaptcha',
       
    ]);
   
    $Service = Services::where('Guid',$request->input('ServiceID'))->first();
    $contactinfo = ContactInfo::first();
    if($Service &&  $contactinfo->Email)
    {   
     
        $Maildata=['name'=>$request->input('Name'),
                  'email'=>$request->input('Email'),
                  'phone'=>$request->input('Phone'),
                  'message'=>$request->input('Message'),
                  'service'=>$Service->Title,
                 ];
                 $data=[
                  'Guid'=>(string) Str::uuid(),
                  'Name'=>$request->input('Name'),
                  'Email'=>$request->input('Email'),
                  'Mobile'=>$request->input('Phone'),
                  'Message'=>$request->input('Message'),
                  'Service'=>$Service->Title,
              ];
         DB::table('service_enquiries')->insert($data);
         Mail::to($contactinfo->Email,'Team Homes')->cc('omar@homes-jordan.com')->send(new ServiceInfo($Maildata));
         $redirecturl=""; 
         if($request->input('locale')=='en')
         {
          $redirecturl=$request->input('locale').'/services/'.urlencode($Service->Slug).'#requestInfo'; 
         }else{
          $redirecturl=$request->input('locale').'/services/'.urlencode($Service->SlugAr).'#requestInfo'; 
         }
        if (Mail::failures()) {
           
            return redirect($redirecturl)->with('error','Error,while sending request.');
        }else{

          return redirect($redirecturl)->with('success','Request submitted successfully .');
        }
        
    }else{

      return redirect()->back()->with('nodata','Error,no data found.');
    }
  }
}
