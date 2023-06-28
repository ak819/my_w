<?php

namespace App\Http\Controllers\web;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\ReuestContactInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\Communities;
use App\Models\PropertyUnitTypes;
use App\Models\Banner;
use App\Models\Property;
use App\Models\Agents;
use App\Models\Testimonials;
use App\Models\Blog;
use App\Models\ContactInfo;
use App\Models\Services;
use App\Models\HeroBanner;
use App\Models\AboutUsImages;
use App\Models\Seourl;
use Illuminate\Support\Facades\Storage;
use App\Mail\Backup;

class HomeController extends Controller
{
    public function __construct()
    
    {
        $this->middleware('setcurrency');
    }
     /*----- 
    Author:Akshay 
    Function:Home page
    -----*/
    public function index()
    {   
        $Data=new \stdClass();
        $item = new \stdClass();
        if(app()->getLocale()=="en")
        {
            $Data->City=Cities::join('properties', 'cities.ID', '=', 'properties.CityID')
            ->where('cities.IsEnable',1)
            ->groupBy('cities.ID')
            ->get(['cities.ID','cities.CityName','cities.CityName AS CityNameEng']);

            $Data->Communities=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
            ->where('communities.IsEnable',1)
            ->groupBy('communities.ID')
            ->orderBy('communities.CommunityName','asc')
            ->get(['communities.ID','communities.CityID','communities.CommunityName','communities.CommunityName AS CommunityNameEng']);

            $Data->PropertyUnitTypes=PropertyUnitTypes::join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
            ->where('property_unit_types.IsEnable',1)
            ->groupBy('property_unit_types.ID')
            ->get(['property_unit_types.ID','property_unit_types.FilterDivId','property_unit_types.TypeName','property_unit_types.TypeName AS TypeNameEng']);
            $Data->Feautured=Property::select(['p.PropertyRefNo','p.Slug','p.AdType','p.Price','p.Guid','p.PropertyTitle','p.PropertyTitle AS PropertyLinkTitle','p.Description','p.NoBedrooms','p.NoBathrooms','p.UnitBuiltupArea','p.PlotSize',
               'c.CityName','pc.CatergoryName','pu.TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameEn AS ImgAlt','cs.CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.Plural AS Plural'])
               ->from('properties as p')
               ->where('p.IsEnable',1)
               ->where('p.IsFeatured',1)
               ->join('cities as c', 'c.ID', '=', 'p.CityID')
               ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
               ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
               ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
               ->leftJoin('propety_agents as pa', 'pa.ID', '=', 'p.AgentID')
               ->leftJoin('property_images as pi', function ($join) {
                $join->on('p.ID', '=', 'pi.PropertyID')
                     ->where('pi.IsThumbnail',0)
                     ->where('pi.IsDownloaded',1);})
               ->skip(0)->take(3)
               ->groupBy('p.ID')
               ->orderBy("p.ID","desc")
               ->get();
               $Data->Exclusive=Property::select(['p.PropertyRefNo','p.Slug','p.AdType','p.Price','p.Guid','p.PropertyTitle','p.PropertyTitle AS PropertyLinkTitle','p.Description','p.NoBedrooms','p.NoBathrooms','p.UnitBuiltupArea','p.PlotSize',
               'c.CityName','pc.CatergoryName','pu.TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameEn AS ImgAlt','cs.CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.Plural AS Plural'])
               ->from('properties as p')
               ->where('p.IsEnable',1)
               ->where('p.IsExclusive',1)
               ->join('cities as c', 'c.ID', '=', 'p.CityID')
               ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
               ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
               ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
               ->leftJoin('propety_agents as pa', 'pa.ID', '=', 'p.AgentID')
               ->leftJoin('property_images as pi', function ($join) {
                $join->on('p.ID', '=', 'pi.PropertyID')
                     ->where('pi.IsThumbnail',0)
                     ->where('pi.IsDownloaded',1);})
               ->skip(0)->take(3)
               ->groupBy('p.ID')
               ->orderBy("p.ID","desc")
               ->get();
               $Data->Agents=Agents::where('IsEnable',1)
              ->get(['DisplayName','DisplayEmail','DisplayPhone','DisplayPhoto','PropertyType']);
              $Data->Testimonials=Testimonials::where('IsEnable',1)
              ->where('CustomerName','!=',NULL)
              ->where('Message','!=',NULL)
              ->get(['CustomerName','Message','Designation','Photo']);
              $Data->Blogs=Blog::where('IsEnable',1)->skip(0)->take(3)->orderBy("ID","desc")->get(['Guid','Title','Slug','Title AS LinkTitle','Description','Image','CreatedDate','Alt']);
              $Data->Services=Services::where('IsEnable',1)->skip(0)->take(3)->orderBy("ID","desc")->get(['Slug','Guid','Title','Title AS LinkTitle','Description','Image','CreatedDate','Alt']);
              $Data->FeaturedLocations = DB::table("communities")
               ->select("communities.ID","communities.Alt","communities.Image","communities.CommunityName","cities.ID as CityID","communities.CommunityName as CommunityNameEng",
                    DB::raw("(SELECT COUNT(properties.ID) FROM properties
                                WHERE properties.CommunityID  = communities.ID 
                                AND properties.AdType= 1
                                GROUP BY properties.CommunityID) as properties_rent_count"),
                    DB::raw("(SELECT COUNT(properties.ID) FROM properties
                                WHERE properties.CommunityID  = communities.ID 
                                AND properties.AdType= 2
                                GROUP BY properties.CommunityID) as properties_sale_count"),
                                DB::raw("(SELECT MIN(properties.Price) FROM properties
                                WHERE properties.CommunityID  = communities.ID 
                                AND properties.AdType= 2 ) as min_sale_price") )
                ->join('cities','cities.ID','=','communities.CityID')
                ->where('communities.IsFeatured',1)
                ->get();
            $Data->AdTypeText=config('constants.AdTypeRev');
        
          $item->MetaTitle='Leading real estate agency for properties in Amman Jordan';
          $item->MetaDescription='Homes Jordan specializes in real estate marketing for villas, apartments, or lands in Amman. With our team of brokers, you can buy, sell or rent your ideal property.';
          

        }else{

         $Data->City=Cities::join('properties', 'cities.ID', '=', 'properties.CityID')
        ->where('cities.IsEnable',1)
        ->groupBy('cities.ID')
        ->get(['cities.ID','cities.CityNameAr AS CityName','cities.CityName As CityNameEng']);

        $Data->Communities=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
        ->where('communities.IsEnable',1)
       ->groupBy('communities.ID')
       ->orderBy('communities.CommunityName','asc')
       ->get(['communities.ID','communities.CityID','CommunityNameAr AS CommunityName','communities.CommunityName AS CommunityNameEng']);

        $Data->PropertyUnitTypes=PropertyUnitTypes::join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
        ->where('property_unit_types.IsEnable',1)
        ->groupBy('property_unit_types.ID')
        ->get(['property_unit_types.ID','property_unit_types.FilterDivId','property_unit_types.TypeNameAr AS TypeName','property_unit_types.TypeName as TypeNameEng']);
        $Data->Feautured=Property::select(['p.PropertyRefNo','p.SlugAr AS Slug','p.AdType','p.Price','p.PropertyTitle AS PropertyLinkTitle','p.Guid','p.PropertyTitleAr AS PropertyTitle','p.DescriptionAr AS 	Description','p.NoBedrooms','p.NoBathrooms','p.UnitBuiltupArea','p.PlotSize',
               'c.CityNameAr AS CityName','pc.CatergoryName','pu.TypeNameAr AS TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameAr AS ImgAlt','cs.CommunityNameAr AS CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.PluralAr AS Plural'])
               ->from('properties as p')
               ->where('p.IsEnable',1)
               ->where('p.IsFeatured',1)
               ->join('cities as c', 'c.ID', '=', 'p.CityID')
               ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
               ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
               ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
               ->leftJoin('property_images as pi', function ($join) {
                $join->on('p.ID', '=', 'pi.PropertyID')
                     ->where('pi.IsThumbnail',0)
                     ->where('pi.IsDownloaded',1);})
               ->leftJoin('propety_agents as pa', 'pa.ID', '=', 'p.AgentID')
               ->skip(0)->take(3)
               ->groupBy('p.ID')
               ->orderBy("p.ID","desc")
               ->get();
               $Data->Exclusive=Property::select(['p.PropertyRefNo','p.SlugAr AS Slug','p.AdType','p.Price','p.PropertyTitle AS PropertyLinkTitle','p.Guid','p.PropertyTitleAr AS PropertyTitle','p.DescriptionAr AS 	Description','p.NoBedrooms','p.NoBathrooms','p.UnitBuiltupArea','p.PlotSize',
               'c.CityNameAr AS CityName','pc.CatergoryName','pu.TypeNameAr AS TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameAr AS ImgAlt','cs.CommunityNameAr AS CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.PluralAr AS Plural'])
               ->from('properties as p')
               ->where('p.IsEnable',1)
               ->where('p.IsExclusive',1)
               ->join('cities as c', 'c.ID', '=', 'p.CityID')
               ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
               ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
               ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
               ->leftJoin('property_images as pi', function ($join) {
                $join->on('p.ID', '=', 'pi.PropertyID')
                     ->where('pi.IsThumbnail',0)
                     ->where('pi.IsDownloaded',1);})
               ->leftJoin('propety_agents as pa', 'pa.ID', '=', 'p.AgentID')
               ->skip(0)->take(3)
               ->groupBy('p.ID')
               ->orderBy("p.ID","desc")
               ->get();
        $Data->Agents=Agents::select(['a.DisplayNameAr AS DisplayName','a.DisplayEmail','a.DisplayPhone','a.DisplayPhoto','PropertyType'])
                ->from('propety_agents as a')
                ->where('a.IsEnable',1)
                ->get();
         $Data->Testimonials=Testimonials::where('IsEnable',1)
          ->where('CustomerNameAr','!=',NULL)
          ->where('MessageAr','!=',NULL)
          ->get(['CustomerNameAr AS CustomerName','MessageAr AS Message','DesignationAr AS Designation','Photo']);
          $Data->Blogs=Blog::where('IsEnable',1)->skip(0)->take(3)->orderBy("ID","desc")->get(['Guid','SlugAr AS Slug','TitleAr AS Title','Title AS LinkTitle','DescriptionAr AS Description','Image','CreatedDate','Alt']);
          $Data->Services=Services::where('IsEnable',1)->skip(0)->take(3)->orderBy("ID","desc")->get(['SlugAr AS Slug','Guid','TitleAr AS Title','Title AS LinkTitle','DescriptionAr AS Description','Image','CreatedDate','Alt']);
          $Data->FeaturedLocations = DB::table("communities")
          ->select("communities.ID","communities.Alt","communities.Image","communities.CommunityNameAr as CommunityName","cities.ID as CityID","communities.CommunityName as CommunityNameEng",
               DB::raw("(SELECT COUNT(properties.ID) FROM properties
                           WHERE properties.CommunityID  = communities.ID 
                           AND properties.AdType= 1
                           GROUP BY properties.CommunityID) as properties_rent_count"),
               DB::raw("(SELECT COUNT(properties.ID) FROM properties
                           WHERE properties.CommunityID  = communities.ID 
                           AND properties.AdType= 2
                           GROUP BY properties.CommunityID) as properties_sale_count"),
                           DB::raw("(SELECT MIN(properties.Price) FROM properties
                           WHERE properties.CommunityID  = communities.ID 
                           AND properties.AdType= 2 ) as min_sale_price") )
           ->join('cities','cities.ID','=','communities.CityID')
           ->where('communities.IsFeatured',1)
           ->get();
           $Data->AdTypeText=config('constants.AdTypeRevAr');
           $item->MetaTitle='هومز لتسويق وإدارة العقارات في عمان الأردن';
           $item->MetaDescription='شركة HOMES الأردن متخصصة في التسويق العقاري للفلل والشقق والأراضي في عمان. مع فريق الوسطاء لدينا ، يمكنك شراء أو بيع أو تأجير عقارك المثالي.';
        
        }
       
        $Data->Banners=Banner::where('IsEnable',1)->get();
        $Data->Seourl=Seourl::where('IsEnable',1)->get()->toArray();
        $Data->UrlUnitTypes=PropertyUnitTypes::select('property_unit_types.ID','property_unit_types.TypeNameAr AS TypeNameAr','property_unit_types.TypeName as TypeNameEng',
        DB::raw("(SELECT COUNT(seourls.ID) FROM seourls
        WHERE property_unit_types.ID  = seourls.UnitTypeID 
        AND seourls.AdType= 1 AND seourls.IsEnable= 1
        GROUP BY seourls.UnitTypeID) as rent_count"),
        DB::raw("(SELECT COUNT(seourls.ID) FROM seourls
        WHERE property_unit_types.ID  = seourls.UnitTypeID 
        AND seourls.AdType= 2 AND seourls.IsEnable= 1
        GROUP BY seourls.UnitTypeID) as sale_count"),
         )
         ->join('seourls', 'property_unit_types.ID', '=', 'seourls.UnitTypeID')
        ->where('property_unit_types.IsEnable',1)
        ->groupBy('property_unit_types.ID')
        ->get();

        $meta="pages";
        return view('web-layouts.home',compact('Data','item','meta'));
    }

    public function getAboutUs()
    {   
        $item = new \stdClass();
        if(app()->getLocale()=="en")
        {
        $Data=new \stdClass();
        $Data->Testimonials=Testimonials::where('IsEnable',1)
        ->where('CustomerName','!=',NULL)
        ->where('Message','!=',NULL)
        ->get(['CustomerName','Message','Designation','Photo']);
        $item->MetaTitle="Homes real estate agency and property marketing in jordan";
        $item->MetaDescription="Top agency in Amman Jordan for selling, buying, or renting your property with specialized agents in commercial and residential listings";
        }else{
            
            $Data=new \stdClass();
            $Data->Testimonials=Testimonials::where('IsEnable',1)
            ->where('CustomerNameAr','!=',NULL)
            ->where('MessageAr','!=',NULL)
            ->get(['CustomerNameAr AS CustomerName','MessageAr AS Message','DesignationAr AS Designation','Photo']);
            $item->MetaTitle="شركة هومز للإدارة  وتسويق العقارات في الأردن ";
            $item->MetaDescription="أفضل شركة في عمان الأردن لبيع وشراء وتأجير العقارات الخاصة بك مع خبراء متخصصين في العقارات التجارية والسكنية";
        }
        $Data->hero_banner=HeroBanner::where('id',1)->value('Image');
        $Data->images=AboutUsImages::get('Image','Alt');
        $meta="pages";
        return view('web-layouts.about-us',compact('Data','item','meta'));

    }
    public function getContactUs()
    {
        $item = new \stdClass();
        if(app()->getLocale()=="en")
        {
            $item->MetaTitle='Get in touch with real estate marketing experts in amman jordan';
            $item->MetaDescription='Contact our agency & connect with expert brokers who will support you to purchase, sell or lease your property. We manage commercial & residential properties & lands in Amman Jordan';
        }else{
            $item->MetaTitle='تواصل مع خبراء التسويق العقاري في عمان الأردن';
            $item->MetaDescription='اتصل بوكالتنا وتواصل مع خبراء الوساطة العقارية  الذين سيدعمونك لشراء أو بيع أو تأجير عقارك. نقوم بإدارة العقارات التجارية والسكنية والأراضي في عمان الأردن';
        }
        $meta="pages";
        return view('web-layouts.contact-us',compact('meta','item'));

    }
    public function createContactEnquiry(Request $request)
    {

        $request->validate([

            'Name' => 'required',
            //'Email' => 'required',
            'Phone' => 'required',
            //'Message' => 'required',
            'g-recaptcha-response' => 'recaptcha',
          ],[
            'g-recaptcha-response.recaptcha' => 'Invalid recaptcha',
           
        ]);
          $contactinfo = ContactInfo::first();
           $redirecturl=$request->input('locale').'/contact-us#contactform';
          if($contactinfo &&  $contactinfo->Email)
          {
            $Maildata=['name'=>$request->input('Name'),
                      'email'=>$request->input('Email'),
                      'phone'=>$request->input('Phone'),
                      'message'=>$request->input('Message'),
                     ];
            $data=[
                'Guid'=>(string) Str::uuid(),
                'Name'=>$request->input('Name'),
                'Email'=>$request->input('Email'),
                'Mobile'=>$request->input('Phone'),
                'Message'=>$request->input('Message'),
            ];
             DB::table('contact_enquiries')->insert($data);
             Mail::to($contactinfo->Email,'Team Homes')
                    ->cc('omar@homes-jordan.com')
                    ->send(new ReuestContactInfo($Maildata));
            
            
            if (Mail::failures()) {
          
                return redirect($redirecturl)->with('error','Error,while sending request.');
            }
            return redirect($redirecturl)->with('success','Request submitted successfully .');
         }else{

                return redirect($redirecturl)->with('nodata','Error,no data found.');
            } 
            
    }

    public function sendBackUpEmail()
    {

       
        if (Storage::disk('local')->exists('backup/2022-10-13.zip')) {
            
            $filename = storage_path('app/backup/') . '2022-10-13.zip';

        try {
            Mail::to('chaudhariakshay28@gmail.com')->send(new Backup($filename));

            echo "Mail sent"; 

        } catch (\Exception $e) {
             echo $e->getMessage();
        }
        }else{

             echo "no";
        }



    }



    
}
