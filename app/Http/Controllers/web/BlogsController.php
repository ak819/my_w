<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\HeroBanner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogsController extends Controller
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
        $item->MetaTitle="The latest news and articles around real estate industry in Jordan";
        $item->MetaDescription="Stay informed about everything related to real estate market and investment in Amman Jordan, with news, updates, and advice from our experts.";
        $items = Blog::where('IsEnable', 1)->orderBy('ID', 'DESC')->get(['Guid','Slug','Title','Title AS LinkTitle','Description','MetaTitle','MetaDescription','Alt','Image','CreatedDate']);
     }else{
        $items = Blog::where('IsEnable', 1)->orderBy('ID', 'DESC')->get(['Guid','SlugAr AS Slug','TitleAr AS Title','Title AS LinkTitle','DescriptionAr AS Description','MetaTitleAr AS AMetaTitle','MetaDescriptionAr AS MetaDescription','Alt AS Alt','Image','CreatedDate']);
        $item->MetaTitle="آخر الأخبار و النصائح و المقالات العقارية  في الأردن";
        $item->MetaDescription="ابق على اطلاع بكل ما يتعلق بسوق العقارات والاستثمار في عمان الأردن ، مع الأخبار و المقالات والنصائح العقارية الموثوقة من خبرائنا.";
     }
     //$items->hero_banner=HeroBanner::where('id',2)->value('Image');
     $meta="pages";
    return view('web-layouts.blogs.blog-list',compact('items','item','meta'));
    }

    public function show($id){
        $item = Blog::where('Guid', $id)->first();
        return view('web-layouts.blogs.blog-details', compact('item'));
    }

    public function blogDetails($Lang=null,$Slug)
    {   
        $Slug=urldecode($Slug);
        if(app()->getLocale()=="en")
        {
        $item = Blog::where('Slug', $Slug)->where('IsEnable', 1)->first(['Guid','Title','Title AS LinkTitle','Description','MetaTitle','MetaDescription','Alt','Image','CreatedDate']);
         $blogLimits = Blog::where('Slug', '!=', $Slug)->where('IsEnable', 1)->orderBy('ID', 'DESC')->take(5)->get(['Guid','Slug','Title','Title AS LinkTitle','Description','MetaTitle','MetaDescription','Alt','Image','CreatedDate']);
        }else{
            $item = Blog::where('SlugAr', $Slug)->where('IsEnable', 1)->first(['Guid','TitleAr AS Title','Title AS LinkTitle','DescriptionAr AS Description','MetaTitleAr AS MetaTitle','MetaDescriptionAr AS MetaDescription','Alt','Image','CreatedDate']);
            $blogLimits = Blog::where('SlugAr','!=', $Slug)->where('IsEnable', 1)->orderBy('ID', 'DESC')->take(5)->get(['Guid','SlugAr AS Slug','TitleAr AS Title','Title AS LinkTitle','DescriptionAr AS Description','MetaTitleAr AS MetaTitle','MetaDescriptionAr AS MetaDescription','Alt','Image','CreatedDate']);
        }
        
        $meta="blog";
        //$item->hero_banner=HeroBanner::where('id',3)->value('Image');
        if($item)
        {
            return view('web-layouts.blogs.blog-details', compact('item','blogLimits','meta'));
        }else{
            //return view('web-layouts.blogs.404');

            return redirect()->route('home');
        }
        
    }


    public function getBlogShareLinks(Request $request)
    {
        $Guid=$request->blogid;
        $Locale=$request->locale;
        $Data= Blog::where('Guid',$Guid)->where('IsEnable', 1)->first(['Guid','Slug','SlugAr']);
        if($Data)
        {    
              $url=route('blogdetails',['en',$Data->Slug]);
              if($Locale=="ar")
              {
                $url=route('blogdetails',['ar',$Data->SlugAr]);
              }
           
            $shortURL = \AshAllenDesign\ShortURL\Models\ShortURL::findByDestinationURL($url);
                                          if(count($shortURL)>0)
                                          { 
                                             $shortLink=$shortURL[0]->default_short_url;
                                          }else{
                                             $builder = new \AshAllenDesign\ShortURL\Classes\Builder();
      
                                             $shortURLObject = $builder
                                             ->destinationUrl($url)->make();
                                             $shortLink=$shortURLObject->default_short_url;
                                          }
            $shareComponent = \Share::page($shortLink)
            ->whatsapp()
            ->facebook()
            ->linkedin();
             $otherlink='<ul><li><a class="btn-social-small btn-email" href="mailto:?subject=I wanted you to share this details&amp; body=Check out this link :"'.$shortURL.'"
             title="Share by Email"  style="color: #fff;" href="javascript:void(0)"><i class="fa fa-envelope"></i>
           </a></li>
           <li><a class="btn-social-small btn-link blogclipboard" data-tocopyshorturl="'.$shortLink.'" style="color: #fff;" href="javascript:void(0)"><i class="fa fa-link"></i></a></li></ul>';

            $response['html']=html_entity_decode($shareComponent).''.$otherlink;
            $response['status']=true;
            return response()->json($response);
            

        }else{

            $response['html']='';
            $response['status']=false;
            return response()->json($response);
        }
       
       
            

    }
   


}
