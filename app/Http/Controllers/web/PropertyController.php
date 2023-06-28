<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestListProperty;
use App\Mail\RequestEvaluation;
use App\Mail\RequestInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\Cities;
use App\Models\Communities;
use App\Models\PropertyUnitTypes;
use App\Models\PropertyEnquiries;
use App\Models\PropertyImages;
use App\Models\Agents;
use App\Models\PropertyList;
use App\Models\ContactInfo;
use App\Models\HeroBanner;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('setcurrency');
    }
    public function propertyList()
    {

    }
   
     /*----- 
    Author:Akshay 
    Function:for property search
    -----*/
    public function getProperties($lang="",$Adtype=null,$Type=null,$City=null,$Locations=null,Request $request)
    {   

        if($request->query->count())
        {

        $item = new \stdClass();
        $AdTypeText=[];
        $OrderCloumn=['new'=>'p.PropertyRefNo','old'=>'p.PropertyRefNo','p-asc'=>'p.Price','p-desc'=>'p.price'];
        $OrderSeq=['new'=>'desc','old'=>'asc','p-asc'=>'asc','p-desc'=>'desc'];
        $locationarray=($request->l)?explode('-',$request->l):"";
        //$adtype=config('constants.AdType.'.$request->adt);
        $adtype=$request->adt;
        $refno=$request->rfn;
        $min_price=$max_price=0;
        $min_price=$request->mnpr;
        $max_price=$request->mxpr;
        if($adtype==2 && $max_price==100000000)
        {
                $max_price=1000000000;
        }
        if($adtype==1 && $max_price==2000000)
        {
            $max_price=200000000;
        }
        $min_floorno=$request->mnfn;
        $max_floorno=$request->mxfn;
        $min_bed=$request->mnbd;
        $max_bed=$request->mxbd;
        $min_bath=$request->mnbt;
        $max_bath=$request->mxbt;
        $min_built_area=$request->mnblt;
        $max_built_area=$request->mxblt;
        $min_land_area=$request->mnplt;
        $max_land_area=$request->mxplt;
        $min_streets=$request->mnsrt;
        $max_streets=$request->mxsrt;
        $min_build_per=$request->mnbpc;
        $max_build_per=$request->mxbpc;
        $min_facade=$request->mnfc;
        $max_facade=$request->mxfc;
        $city=$request->c;
        $unittype=$request->t;
        $apartment_type=$request->apt;
        $residential_land_type=$request->rsdt;
        $commercial_type=$request->ct;
        $villa_type=$request->vt;
        $build_facade_type=$request->bft;
        $furnished=$request->frsh;
        $floor_no=$request->fn;
        $swimmingpool=$request->swm;
        $outedoor=$request->oa;
        $serviced=$request->sv;
        $fitted=$request->ft;
        $parking=$request->pl;
        $rented=$request->rd;
        $floortype=$request->flt;
        $Orderby=($request->odr)?$OrderCloumn[$request->odr]:"";
        $query= Property::query();
        $City=($City)?$City:"Amman Jordan";
       

        $Metadata=getPropertyMetaTitleDesc(app()->getLocale(),$adtype,$unittype,$city);
        $item->MetaTitle= $Metadata['title'];
        $item->MetaDescription=$Metadata['desc'];

        if(app()->getLocale()=="en")
        {
            $AdTypeText=config('constants.AdTypeRev');
           
         $query->select(['p.*','p.PropertyTitle AS PropertyLinkTitle','c.CityName','pc.CatergoryName','pu.TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameEn AS ImgAlt','cs.CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.Plural AS Plural']);
        }else{
           
            // if($adtype==1)
            // {
            //     $item->MetaTitle='شقق وفلل وأراضي وعقارات تجارية للإيجار في عمان الأردن';
            //     $item->MetaDescription='وسطاء عقاريين مختصين وخبراء تسويق في تأجير العقارات والعروض المميزة في دابوق وعبدون وديرغبار ومناطق أخرى في غرب عمان الأردن';
            // }else{
            //     $item->MetaTitle='ابحث عن عقارات سكنية وتجارية للبيع في عمان الأردن';
            //     $item->MetaDescription='أفضل شركة تسويق ووساطة عقارية لبيع وشراء العقارات. أفضل عروض لبيع: الفلل ، الشقق ، المكاتب ، المعارض ، المجمعات ، والأراضي  في عمان الأردن';
            // }
            $AdTypeText=config('constants.AdTypeRevAr');
            $query->select(['p.Guid','p.AdType','p.SlugAr AS Slug','p.PropertyRefNo','p.Price','p.PropertyTitle AS PropertyLinkTitle','p.PropertyTitleAr AS PropertyTitle','p.DescriptionAr AS Description','p.NoBedrooms','p.NoBathrooms','p.UnitBuiltupArea','p.PlotSize','c.CityNameAr AS CityName','pc.CatergoryName','pu.TypeNameAr AS TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameAr AS ImgAlt','cs.CommunityNameAr AS CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.PluralAr AS Plural']);
        }
                $query->from('properties as p')
                ->join('cities as c', 'c.ID', '=', 'p.CityID')
                ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
                ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
                ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
                ->leftJoin('propety_agents as pa', 'pa.ID', '=', 'p.AgentID');
               // ->leftJoin('property_images as pi','pi.PropertyID','=','p.ID');
                $query->leftJoin('property_images as pi', function ($join) {
                    $join->on('p.ID', '=', 'pi.PropertyID')
                         ->where('pi.IsThumbnail',0)
                         ->where('pi.IsDownloaded',1);
                });

        if($refno)
        {
            $query->where('PropertyRefNo', 'LIKE', "%{$refno}%"); 
        }
        if($adtype)
        {
         $query->where('AdType',$adtype);   
        }
        if($city && !$locationarray)
        {
            $query->where('p.CityID',$city); 
        }
        if($locationarray)
        {
            $query->whereIn('p.CommunityID',$locationarray); 
        }
        if($floor_no ||  $floor_no!="")
        {
            $query->where('Floor',$floor_no);
        }
        if($unittype)
        {
            $query->where('UnitTypeID',$unittype); 
        }
        if($apartment_type)
        {
            $query->where('ApartmentType',$apartment_type); 
        }
        if($residential_land_type)
        {
            $query->where('ResidentialLandType',$residential_land_type); 
        }
        if($commercial_type)
        {
            $query->where('CommercialType',$commercial_type); 
        }
        if($villa_type)
        {
            $query->where('VillaType',$villa_type); 
        }
        if($build_facade_type)
        {
            $query->where('BuildFacadeType',$build_facade_type); 
        }
        if($outedoor)
        {
            $query->where('OutdoorArea',$outedoor);    
        }
        ($furnished == "Yes")? $query->whereIn('Furnished',['1','3'])  :"";
        ($furnished == "No")?  $query->whereIn('Furnished',['0','2'])  :"";
        if($swimmingpool)
        {
            $query->where('SwimmingPool',$swimmingpool); 
        }
        if($serviced)
        {
            $query->where('Serviced',$swimmingpool); 
        }
        // if($parking)
        // {  
        //     ($parking == "Yes")? $query->where('Parking','>',0)  : $query->where('Parking',0);
        // }
        if($rented)
        {
            $query->where('Rented',$rented); 
        }
        if($floortype)
        {
            $query->where('FloorType',$floortype);
        }
        if($min_price && $max_price)
        {
           
            $query->whereBetween('Price',[$min_price,$max_price]); 
        }
        if($min_price && !$max_price)
        {
            
            $query->where('Price','>=',$min_price); 
        }
        if(!$min_price && $max_price)
        {
            
            $query->where('Price','<=',$max_price); 
        }
        if($min_floorno && $max_floorno)
        {
            $query->whereBetween('NoFloors',[$min_floorno,$max_floorno]); 
        }
        if($min_floorno && !$max_floorno)
        {
            $query->where('NoFloors','>=',$min_floorno); 
        }
        if(!$min_floorno && $max_floorno)
        {
            $query->where('NoFloors','<=',$max_floorno); 
        }
        if(in_array($unittype,[1,9,6]))
        {
            if($min_bed && $max_bed)
            {
                $query->whereBetween('NoBedrooms',[$min_bed,$max_bed]); 
            }
            if($min_bed && !$max_bed)
            {
                $query->where('NoBedrooms','>=',$min_bed); 
            }
            if(!$min_bed && $max_bed)
            {
                $query->where('NoBedrooms','<=',$max_bed); 
            }
        }
        if($min_bath && $max_bath)
        {
            $query->whereBetween('NoBathrooms',[$min_bath,$max_bath]); 
        }
        if($min_bath && !$max_bath)
        {
            $query->where('NoBathrooms','>=',$min_bath); 
        }
        if(!$min_bath && $max_bath)
        {
            $query->where('NoBathrooms','<=',$max_bath); 
        }
        if($min_built_area && $max_built_area)
        {
            $query->whereBetween('UnitBuiltupArea',[$min_built_area,$max_built_area]); 
        }
        if($min_built_area && !$max_built_area)
        {
            $query->where('UnitBuiltupArea','>=',$min_built_area); 
        }
        if(!$min_built_area && $max_built_area)
        {
            $query->where('UnitBuiltupArea','<=',$max_built_area); 
        }
        if($min_land_area && $max_land_area)
        {
            $query->whereBetween('PlotSize',[$min_land_area,$max_land_area]); 
        }
        if($min_land_area && !$max_land_area)
        {
            $query->where('PlotSize','>=',$min_land_area); 
        }
        if(!$min_land_area && $max_land_area)
        {
            $query->where('PlotSize','<=',$max_land_area); 
        }
        if($min_streets && $max_streets)
        {
            $query->whereBetween('Nostreets',[$min_streets,$max_streets]); 
        }
        if($min_streets && !$max_streets)
        {
            $query->where('Nostreets','>=',$min_streets); 
        }
        if(!$min_streets && $max_streets)
        {
            $query->where('Nostreets','<=',$max_streets); 
        }
        if($min_build_per && $max_build_per)
        {
            $query->whereBetween('BuildPercentageNumber',[$min_build_per,$max_build_per]); 
        }
        if($min_build_per && !$max_build_per)
        {
            $query->where('BuildPercentageNumber','>=',$min_build_per);
        }
        if(!$min_build_per && $max_build_per)
        {
            $query->where('BuildPercentageNumber','<=',$max_build_per);
        }
        if($min_facade && $max_facade)
        {
            $query->whereBetween('FacadeNumber',[$min_facade,$max_facade]); 
        }
        if($min_facade && !$max_facade)
        {
            $query->where('FacadeNumber','>=',$min_facade); 
        }
        if(!$min_facade && $max_facade)
        {
            $query->where('FacadeNumber','<=',$max_facade); 
        }
            $query->where('p.IsEnable',1);
            $query->groupBy('p.PropertyRefNo');
            if($Orderby)
            {
                $query->orderBy($Orderby,$OrderSeq[$request->odr]);
            }else
            {
                $query->orderBy("p.PropertyRefNo","desc");
            }
            $Data=new \stdClass();
            $Data->Count=$query->get()->count();
            $Data->Result=$query->paginate(21);
            if(app()->getLocale()=="en")
            {
            $Data->City=Cities::join('properties', 'cities.ID', '=', 'properties.CityID')
                                 ->where('cities.IsEnable',1)
                                 ->groupBy('cities.ID')
                                 ->orderBy('cities.CityName','asc')
                                 ->get(['cities.ID','cities.CityName','cities.CityName AS CityNameEng']);
            if($city)
            { 
                $Data->Locations=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                ->where('communities.CityID',$city)
                ->where('communities.IsEnable',1)
                ->groupBy('communities.ID')
                ->orderBy('communities.CommunityName','asc')
                ->get(['communities.ID','communities.CityID','communities.CommunityName','communities.CommunityName AS CommunityNameEng']);

            }else{
                $Data->Locations=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                ->where('communities.IsEnable',1)
                ->groupBy('communities.ID')
                ->orderBy('communities.CommunityName','asc')
                ->get(['communities.ID','communities.CityID','communities.CommunityName','communities.CommunityName AS CommunityNameEng']); 
            }                    
           

            $Data->PropertyUnitTypes=PropertyUnitTypes::join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
            ->where('property_unit_types.IsEnable',1)
            ->groupBy('property_unit_types.ID')
            ->get(['property_unit_types.ID','property_unit_types.FilterDivId','property_unit_types.TypeName','property_unit_types.TypeName AS TypeNameEng']);
            }else{
                $Data->City=Cities::join('properties', 'cities.ID', '=', 'properties.CityID')
                                 ->where('cities.IsEnable',1)
                                 ->groupBy('cities.ID')
                                 ->orderBy('cities.CityName','asc')
                                 ->get(['cities.ID','cities.CityNameAr AS CityName','cities.CityName AS CityNameEng']);
             if($city){
                $Data->Locations=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                                 ->where('communities.CityID',$city)
                                 ->where('communities.IsEnable',1)
                                 ->groupBy('communities.ID')
                                 ->orderBy('communities.CommunityName','asc')
                                 ->get(['communities.ID','communities.CityID','communities.CommunityNameAr AS CommunityName','communities.CommunityName AS CommunityNameEng']);
             }else{

                $Data->Locations=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                ->where('communities.IsEnable',1)
                ->groupBy('communities.ID')
                ->orderBy('communities.CommunityName','asc')
                ->get(['communities.ID','communities.CityID','communities.CommunityNameAr AS CommunityName','communities.CommunityName AS CommunityNameEng']);

             }                   
           

            $Data->PropertyUnitTypes=PropertyUnitTypes::join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
            ->where('property_unit_types.IsEnable',1)
            ->groupBy('property_unit_types.ID')
            ->get(['property_unit_types.ID','property_unit_types.FilterDivId','property_unit_types.TypeNameAr AS TypeName','property_unit_types.TypeName AS TypeNameEng']);


            }

          

           $meta="pages";

           
            return view('web-layouts.properties.list', compact('Data','item','meta','AdTypeText'));
        }else{

            $UnitType="";
        if($Type)
        {   
           
            $UnitType=PropertyUnitTypes::where('Slug',$Type)->first();
            if(!$UnitType)
            {
                abort(404);
            }
        }

            $item = new \stdClass();
        $query= Property::query();
        $AdTypeText=[];
        $OrderCloumn=['new'=>'p.PropertyRefNo','old'=>'p.PropertyRefNo','p-asc'=>'p.Price','p-desc'=>'p.price'];
        $OrderSeq=['new'=>'desc','old'=>'asc','p-asc'=>'asc','p-desc'=>'desc'];
        $Orderby=($request->odr)?$OrderCloumn[$request->odr]:"";
        $Adtype=($Adtype == "sale")? 2 : 1;
        $Metadata=getPropertyMetaTitleDesc(app()->getLocale(),$Adtype,$UnitType,'Amman Jordan');
        $item->MetaTitle= $Metadata['title'];
        $item->MetaDescription=$Metadata['desc'];

        if(app()->getLocale()=="en")
        {
           
            $AdTypeText=config('constants.AdTypeRev');
           
         $query->select(['p.*','p.PropertyTitle AS PropertyLinkTitle','c.CityName','pc.CatergoryName','pu.TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameEn AS ImgAlt','cs.CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.Plural AS Plural']);
        }else{
           
            $item->MetaTitle='ابحث عن عقارات سكنية وتجارية للبيع في عمان الأردن';
            $item->MetaDescription='أفضل شركة تسويق ووساطة عقارية لبيع وشراء العقارات. أفضل عروض لبيع: الفلل ، الشقق ، المكاتب ، المعارض ، المجمعات ، والأراضي  في عمان الأردن';
            
            $AdTypeText=config('constants.AdTypeRevAr');
            $query->select(['p.Guid','p.AdType','p.SlugAr AS Slug','p.PropertyRefNo','p.Price','p.PropertyTitle AS PropertyLinkTitle','p.PropertyTitleAr AS PropertyTitle','p.DescriptionAr AS Description','p.NoBedrooms','p.NoBathrooms','p.UnitBuiltupArea','p.PlotSize','c.CityNameAr AS CityName','pc.CatergoryName','pu.TypeNameAr AS TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameAr AS ImgAlt','cs.CommunityNameAr AS CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.PluralAr AS Plural']);
        }

        
                $query->from('properties as p')
                ->join('cities as c', 'c.ID', '=', 'p.CityID')
                ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
                ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
                ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
                ->leftJoin('propety_agents as pa', 'pa.ID', '=', 'p.AgentID');
                //->leftJoin('property_images as pi','pi.PropertyID','=','p.ID');
                $query->leftJoin('property_images as pi', function ($join) {
                    $join->on('p.ID', '=', 'pi.PropertyID')
                         ->where('pi.IsThumbnail',0)
                         ->where('pi.IsDownloaded',1);
                });
      
            $query->where('p.IsEnable',1);
            $query->where('p.AdType',$Adtype);
            if($UnitType){
                $query->where('p.UnitTypeID',$UnitType->ID);     
            }
            $query->groupBy('p.PropertyRefNo');
            if($Orderby)
            {
                $query->orderBy($Orderby,$OrderSeq[$request->odr]);
            }else
            {
                $query->orderBy("p.PropertyRefNo","desc");
            }
            $Data=new \stdClass();
            $Data->Count=$query->get()->count();
            $Data->Result=$query->paginate(21);
            if(app()->getLocale()=="en")
            {
            $Data->City=Cities::join('properties', 'cities.ID', '=', 'properties.CityID')
                                 ->where('cities.IsEnable',1)
                                 ->groupBy('cities.ID')
                                 ->orderBy('cities.CityName','asc')
                                 ->get(['cities.ID','cities.CityName','cities.CityName AS CityNameEng']);
           
                $Data->Locations=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                ->where('communities.IsEnable',1)
                ->groupBy('communities.ID')
                ->orderBy('communities.CommunityName','asc')
                ->get(['communities.ID','communities.CityID','communities.CommunityName']); 
                              
           

            $Data->PropertyUnitTypes=PropertyUnitTypes::join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
            ->where('property_unit_types.IsEnable',1)
            ->groupBy('property_unit_types.ID')
            ->get(['property_unit_types.ID','property_unit_types.FilterDivId','property_unit_types.TypeName','property_unit_types.TypeName AS TypeNameEng']);
            }else{
                $Data->City=Cities::join('properties', 'cities.ID', '=', 'properties.CityID')
                                 ->where('cities.IsEnable',1)
                                 ->groupBy('cities.ID')
                                 ->orderBy('cities.CityName','asc')
                                 ->get(['cities.ID','cities.CityNameAr AS CityName','cities.CityName AS CityNameEng']);
            

                $Data->Locations=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                ->where('communities.IsEnable',1)
                ->groupBy('communities.ID')
                ->orderBy('communities.CommunityName','asc')
                ->get(['communities.ID','communities.CityID','communities.CommunityNameAr AS CommunityName']);

                              
           

            $Data->PropertyUnitTypes=PropertyUnitTypes::join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
            ->where('property_unit_types.IsEnable',1)
            ->groupBy('property_unit_types.ID')
            ->get(['property_unit_types.ID','property_unit_types.FilterDivId','property_unit_types.TypeNameAr AS TypeName','property_unit_types.TypeName AS TypeNameEng']);


            }

        $meta="pages";
        if($Adtype==2)
        {
            return view('web-layouts.properties.list-all-sale', compact('Data','item','meta','AdTypeText','UnitType','Adtype'));
        }else{
            return view('web-layouts.properties.list-all-rent', compact('Data','item','meta','AdTypeText','UnitType','Adtype'));
        }
       

            


        }
        
    }

    public function getPropertyDetails($Lang=null,$AdtType,$catergory,$PropetyTitle,$refno)
    {  
        //$Slug=urldecode($PropetyTitle);
        $meta="no";
        if(app()->getLocale()=="en")
        {
        $Data= Property::from('properties as p')
               ->where('p.PropertyRefNo',$refno)
               ->join('cities as c', 'c.ID', '=', 'p.CityID')
               ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
               ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
               ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
               ->join('propety_agents as pa', 'pa.ID', '=', 'p.AgentID')
               ->get(['p.*','p.PropertyTitle AS PropertyLinkTitle','Description','p.Description AS LinkDescription','c.CityName','pc.CatergoryName','pu.Slug as TypeName','cs.CommunityName','pa.DisplayName','pa.DisplayEmail','pa.DisplayPhone','pa.DisplayPhoto','pu.DetailsViewFields'])
               ->first();
      
               if($Data)
               {   
                $Data->MetaTitle=$Data->PropertyTitle.' '.$Data->PropertyRefNo;
                $Data->MetaDesc=$Data->PropertyTitle.' '.$Data->CityName.' '.$Data->CommunityName.' '.$Data->PropertyRefNo;
                   $Data->Images=PropertyImages::select(['pi.Guid','pi.FileName','pi.ImageNameEn AS ImgAlt'])
                   ->where('PropertyID',$Data->ID)
                   ->where('IsThumbnail',0)
                   ->where('IsDownloaded',1)
                   ->from('property_images as pi')
                    ->groupBy('ImageUrl')
                     ->orderBy('pi.ID','ASC')
                   ->get();
                   $Data->Thumbs=PropertyImages::select(['pi.Guid','pi.FileName','pi.ImageNameEn AS ImgAlt'])
                   ->where('PropertyID',$Data->ID)
                   ->where('IsThumbnail',1)
                   ->where('IsDownloaded',1)
                   ->from('property_images as pi')
                    ->groupBy('ImageUrl')
                     ->orderBy('pi.ID','ASC')
                   ->get();
                   $meta="property";   
               }
        }else{
            $Data= Property::from('properties as p')
            ->where('p.PropertyRefNo',$refno)
            ->join('cities as c', 'c.ID', '=', 'p.CityID')
            ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
            ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
            ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
            ->join('propety_agents as pa', 'pa.ID', '=', 'p.AgentID')
            ->get(['p.*','p.PropertyTitle AS PropertyLinkTitle','p.Description AS LinkDescription', 'p.PropertyTitleAr AS PropertyTitle','p.DescriptionAr AS Description','c.CityNameAr AS CityName','pc.CatergoryName','pu.TypeName','cs.CommunityNameAr AS CommunityName','pa.DisplayNameAr AS DisplayName','pa.DisplayEmail','pa.DisplayPhone','pa.DisplayPhoto','pu.DetailsViewFields'])
            ->first();

            
            if($Data)
            {   
                $Data->MetaTitle=$Data->PropertyTitle.' '.$Data->PropertyRefNo;
                $Data->MetaDesc=$Data->PropertyTitleAr.' '.$Data->CityNameAr.' '.$Data->CommunityNameAr.' '.$Data->PropertyRefNo;
                $Data->Images=PropertyImages::select(['pi.Guid','pi.FileName','pi.ImageNameAr AS ImgAlt'])
                ->where('PropertyID',$Data->ID)
                ->where('IsThumbnail',0)
                ->where('IsDownloaded',1)
                ->from('property_images as pi')
                 ->groupBy('ImageUrl')
                  ->orderBy('pi.ID','ASC')
                ->get();
                $Data->Thumbs=PropertyImages::select(['pi.Guid','pi.FileName','pi.ImageNameAr AS ImgAlt'])
                ->where('PropertyID',$Data->ID)
                ->where('IsThumbnail',1)
                ->where('IsDownloaded',1)
                ->from('property_images as pi')
                 ->groupBy('ImageUrl')
                 ->orderBy('pi.ID','ASC')
                ->get();
                $meta="property";
            }
            

        }
    
        if($Data)
        {
            if($Data->Status=="Sold" && $Data->IsEnable==0)
            {
                $flag="sold";
                return view('web-layouts.properties.sold-rented', compact('Data','meta','flag'));

            }elseif($Data->Status=="Rented" && $Data->IsEnable==0)
            {   
                $flag="rented";
                return view('web-layouts.properties.sold-rented', compact('Data','meta','flag'));
            }
        //    elseif($Data->IsEnable==0)
        //     {
        //         return view('web-layouts.properties.404');
        //     }
            else
            {
                return view('web-layouts.properties.details', compact('Data','meta'));
            }

        }else{
            return redirect()->route('home');
            //return view('web-layouts.properties.404');
        }
  
      

    }


    public function createEnquiry(Request $request)
    { 
      
          
    
        $request->validate([

            'Name' => 'required',
            //'Email' => 'required',
            'Phone' => 'required',
            //'Message' => 'required',
            'PropertyID'=>'required',
            'g-recaptcha-response' => 'recaptcha',
          ],[
            'g-recaptcha-response.recaptcha' => 'Invalid recaptcha',
           
        ]);
         $Property=Property::where('properties.Guid',$request->input('PropertyID'))
         ->Join('propety_agents as pa', 'pa.ID', '=', 'properties.AgentID')
                ->get(['PropertyTitle','Slug','SlugAr','AdType','pa.Plural','pa.PluralAr','PropertyRefNo','AgentID','properties.ID'])
                ->first();
        $PropertyLinkTitle=trim(preg_replace("/[^A-Za-z0-9\-]/", '-', $Property->PropertyTitle));
        
       $redirecturl=url($request->input('locale').'/'.config('constants.AdTypeRev.'.$Property->AdType).'/'.$Property->Plural.'/'.$Property->Slug.'/'.$Property->PropertyRefNo.'#requestInfo');
            if($request->input('locale')=="ar")
            {
            
               $redirecturl=url($request->input('locale').'/'.config('constants.AdTypeRevAr.'.$Property->AdType).'/'.$Property->PluralAr.'/'.$Property->SlugAr.'/'.$Property->PropertyRefNo.'#requestInfo');
            }
        $Agentdetails=Agents::where('ID',$Property->AgentID)->get()->first();
        if($Property &&  $Agentdetails)
        {   
            
            $Enquiry=new PropertyEnquiries();
            $Enquiry->Guid=(string) Str::uuid();
            $Enquiry->Name=$request->input('Name');
            $Enquiry->Email=$request->input('Email');
            $Enquiry->Phone=$request->input('Phone');
            $Enquiry->Message=$request->input('Message');
            $Enquiry->PropertyID=$Property->ID;
            $Enquiry->save();
            $Maildata=['name'=>$request->input('Name'),
                      'email'=>$request->input('Email'),
                      'phone'=>$request->input('Phone'),
                      'message'=>$request->input('Message'),
                      'propertyno'=>$Property->PropertyRefNo,
                      'agentname'=>$Agentdetails->DisplayName];
            Mail::to($Agentdetails->DisplayEmail,$Agentdetails->DisplayName)
                       ->cc('omar@homes-jordan.com')
                       ->send(new RequestInfo($Maildata));
          
            
            
       

            if (Mail::failures()) {
       
                return redirect($redirecturl)->with('error','Error,while sending request.');
            }
            return redirect($redirecturl)->with('success','Request submitted successfully .');
        }else{

            return redirect($redirecturl)->with('error','Error,no data found.');
        }
        
    }
    
    public function addCompareProperty(Request $request)
    {   
        $CompareList=session('comparelist');
        $PropertyRefNo=$request->property_no;
        $PropertyArray=[]; 
        if($CompareList)
        {  if(!in_array($PropertyRefNo,$CompareList) && count($CompareList) < 4)
            {
                session()->push('comparelist', $PropertyRefNo); 
                $response['status']=true;
                return response()->json($response);

            }else{

                $response['status']=false;
                return response()->json($response);
            } 
            
        }else{
            session()->put('comparelist', []);
            session()->push('comparelist', $PropertyRefNo);
            $response['status']=true;
            return response()->json($response);
        }
      
       

    }

    public function removeCompareProperty(Request $request)
    {
        $CompareList=session('comparelist');
        $PropertyRefNo=$request->property_no;
        $PropertyArray=[]; 
        if($CompareList)
        {
            if (($key = array_search($PropertyRefNo, $CompareList)) !== false) {

                unset($CompareList[$key]);
                session()->forget('comparelist');
                session()->put('comparelist',$CompareList);
            }
            
        }
         return true;
      


    }
    public function showCompareProperty(Request $request)
    {
        $CompareList=session('comparelist');
        $Lang=$request->lang;
        if($CompareList)
        {    
            
            $html="";
            $propertycount=0;
            foreach($CompareList as $RefNo)
            {   
                if($Lang=="en")
                {
                $data=Property::where('PropertyRefNo',$RefNo)
                ->where('properties.IsEnable',1)
                ->leftJoin('property_images as pi', function ($join) {
                    $join->on('properties.ID', '=', 'pi.PropertyID')
                         ->where('pi.IsThumbnail',0)
                         ->where('pi.IsDownloaded',1);})
                ->get(['PropertyTitle','PropertyRefNo','PropertyTitleAr','Price','pi.FileName','pi.IsDownloaded','pi.ImageNameEn AS ImgAlt'])
                ->first();
                }else{
                    $data=Property::where('PropertyRefNo',$RefNo)
                    ->where('properties.IsEnable',1)
                    ->leftJoin('property_images as pi', function ($join) {
                        $join->on('properties.ID', '=', 'pi.PropertyID')
                             ->where('pi.IsThumbnail',0)
                             ->where('pi.IsDownloaded',1);})
                    ->get(['PropertyRefNo','PropertyTitleAr AS PropertyTitle','Price','pi.FileName','pi.IsDownloaded','pi.ImageNameAr AS ImgAlt'])
                    ->first();
                }
                if($data)
                {
                    $propertycount++;

                    $html.='<div class="col-xl-3 col-lg-2 col-md-3 col-sm-3 col-6 center border-right">';
                    if($data->FileName)
                    {
                        $html.='<img src="'.asset("uploads/properties/orignal/".$data->PropertyRefNo."/".$data->FileName).'" width="30%" alt="'.$data->ImgAlt.'">';
                    }else{
                        $html.='<img src="'.asset('images/noimg.jpg').'" width="30%" alt="no image">';
                    }
                    $html.='<p class="font-size-12 font-wt-500 mt-1 mb-1">'.$data->PropertyRefNo.'</p></div>';
                   // $html.='<p class="font-size-12 font-wt-500 mt-1 mb-1">'.$data->PropertyTitle.'</p>
                    //<p class="font-size-14 font-wt-600 mb-0 color-gold">'.currency_format($data->Price).'</p></div>';
                }

            }
           if($propertycount)
           {

            $response['html']=$html;
            $response['status']=true;
            $response['limitmsg']=(count($CompareList)> 3)? true : false;
            $response['singlelimitmsg']=(count($CompareList)==1)? true : false;

           return response()->json($response);

           }else{
            $response['html']='';
            $response['status']=false;
            $response['limitmsg']=false;
            $response['singlelimitmsg']=false;
 
            return response()->json($response);
           }
           
        }else{
            $response['html']='';
            $response['status']=false;
            $response['limitmsg']=false;
            $response['singlelimitmsg']=false;
 
            return response()->json($response);
        }


    }
    public function deleteCompareProperty()
    {
        session()->put('comparelist', []);
        return true;

    }

    public function getCompareProperty()
    {  
        $CompareList=session('comparelist');
        if($CompareList)
        {   
            
        if(app()->getLocale()=="en")
        {
            $Data= Property::from('properties as p')
             ->whereIn('PropertyRefNo',$CompareList)
            ->join('cities as c', 'c.ID', '=', 'p.CityID')
            ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
            ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
            ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
            ->leftJoin('property_images as pi','pi.PropertyID','=','p.ID')
            ->groupBy('p.PropertyRefNo')
            ->get(['p.*','c.CityName','pc.CatergoryName','pu.TypeName','cs.CommunityName','pi.FileName','pi.IsDownloaded','pi.ImageNameEn AS ImgAlt']);
        }else{

            $Data= Property::from('properties as p')
            ->whereIn('PropertyRefNo',$CompareList)
           ->join('cities as c', 'c.ID', '=', 'p.CityID')
           ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
           ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
           ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
           ->leftJoin('property_images as pi','pi.PropertyID','=','p.ID')
           ->groupBy('p.PropertyRefNo')
           ->get(['p.*','p.PropertyTitleAr AS PropertyTitle','c.CityNameAr AS CityName','pc.CatergoryName','pu.TypeNameAr AS TypeName','cs.CommunityNameAr AS CommunityName','pi.FileName','pi.IsDownloaded','pi.ImageNameAr AS ImgAlt']);


        }
            return view('web-layouts.properties.compare-property', compact('Data'));
        }else{
           
            
            return view('web-layouts.properties.compare-404');
        }

    }
    public function listNewProperty()
    { 
        $item = new \stdClass();
        if(app()->getLocale()=="en")
        {
            $item->MetaTitle='List your property for rent or sale with Homes in Amman Jordan';
            $item->MetaDescription='List your property with Homes to guarantee exceptional service and build long-term relationships. We manage properties for individuals, investors & corporate clients.';
        }else{
            $item->MetaTitle='اعرض عقارك للإيجار أو للبيع مع هومز في عمان الأردن';
            $item->MetaDescription='اعرض عقاراتك مع هومز لضمان خدمة استثنائية وبناء علاقات طويلة الأمد. نحن ندير العقارات للأفراد والمستثمرين و الشركات.';
        }
        $meta="pages";
        //$item->hero_banner=HeroBanner::where('id',6)->first(['Image','Alt']);
        return view('web-layouts.properties.list-property',compact('item','meta'));
    }
    public function storeListProperty(Request $request)
    {
        $validatedData = $request->validate([
            'Name' => 'required',
            'Mobile' => 'required',
            //'Email' => 'required',
            //'Message'  => 'required',
            'g-recaptcha-response' => 'recaptcha',
        ],[
          'g-recaptcha-response.recaptcha' => 'Invalid recaptcha',
         
      ]);
        $Guid = (string) Str::uuid();
        $input = $request->all();
     
        $property = new PropertyList;
        $property->Guid = (string) Str::uuid();
        $property->Name = $input['Name'];
        $property->Mobile = $input['Mobile'];
        $property->Email = (isset($input['Email']))? $input['Email'] : "";
        $property->Message = (isset($input['Message']))? $input['Message'] : "";
        $property->IFollowup = 0;
        $property->save();
        $contactinfo = ContactInfo::first();
          if($contactinfo &&  $contactinfo->Email)
          {
            $Maildata=['name'=>$input['Name'],
                      'email'=>(isset($input['Email']))? $input['Email'] : "",
                      'phone'=>$input['Mobile'],
                      'message'=>(isset($input['Message']))? $input['Message']: "",
                     ];
            
             Mail::to($contactinfo->Email,'Team Homes')
             ->cc('omar@homes-jordan.com')
             ->send(new RequestListProperty($Maildata));
    
            if (Mail::failures()) {
          
                return redirect()->back()->with('error','Error,while sending request.');
            }
            return redirect()->back()->with('success','Thank you, we have received your request. One of our agents will contact you shortly.');
         }else{

                return redirect()->back()->with('nodata','Error,no data found.');
            } 
         
    }

    public function getProperyShareLinks(Request $request)
    {
        $PropertyRefNo=$request->propertyno;
        $Locale=$request->locale;

        $Data=Property::where('PropertyRefNo',$PropertyRefNo)
                ->Join('propety_agents as pa', 'pa.ID', '=', 'properties.AgentID')
                ->get(['PropertyTitle','Slug','SlugAr','AdType','pa.Plural','pa.PluralAr','PropertyRefNo'])
                ->first();
        if($Data)
        {
            $PropertyLinkTitle=trim(preg_replace("/[^A-Za-z0-9\-]/", '-', $Data->PropertyTitle)); 

            $url=route('property-details',['en',config('constants.AdTypeRev.'.$Data->AdType),$Data->Plural,$Data->Slug,$Data->PropertyRefNo]);
            if($Locale=="ar")
            {
              $url=route('property-details',['ar',config('constants.AdTypeRevAr.'.$Data->AdType),$Data->PluralAr,$Data->SlugAr,$Data->PropertyRefNo]);
            }

            //$url=route('property-details',[$Locale,'sale',$PropertyLinkTitle,$Data->Guid]);
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
           <li><a class="btn-social-small btn-link clipboard" data-tocopyshorturl="'.$shortLink.'" style="color: #fff;" href="javascript:void(0)"><i class="fa fa-link"></i></a></li></ul>';

            $response['html']=html_entity_decode($shareComponent).''.$otherlink;
            $response['status']=true;
            return response()->json($response);
            

        }else{

            $response['html']='';
            $response['status']=false;
            return response()->json($response);
        }
       
       
            

    }

    public function ShowFeatured(Request $request)
    {   
        $item = new \stdClass();
        $query= Property::query();
        $AdTypeText=[];
        $OrderCloumn=['new'=>'p.PropertyRefNo','old'=>'p.PropertyRefNo','p-asc'=>'p.Price','p-desc'=>'p.price'];
        $OrderSeq=['new'=>'desc','old'=>'asc','p-asc'=>'asc','p-desc'=>'desc'];
        $Orderby=($request->odr)?$OrderCloumn[$request->odr]:"";
        if(app()->getLocale()=="en")
        {
           
    
            $item->MetaTitle='Featured properties in amman at Homes real estate agency';
            $item->MetaDescription='Featured properties in Amman Jordan selected for their high standards and quality';
        
            $AdTypeText=config('constants.AdTypeRev');
           
            $query->select(['p.*','p.PropertyTitle AS PropertyLinkTitle','c.CityName','pc.CatergoryName','pu.TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameEn AS ImgAlt','cs.CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.Plural AS Plural']);
        }else{
           
          
            $item->MetaTitle='عقارات مميزة لدى شركة هومز';
            $item->MetaDescription='أفضل العقارات المسوقة لدى هومز. يمكنك البحث عن عقارك للبيع أو للأجار في عمان الأردن';
           
            $AdTypeText=config('constants.AdTypeRevAr');
            $query->select(['p.Guid','p.AdType','p.SlugAr AS Slug','p.PropertyRefNo','p.Price','p.PropertyTitle AS PropertyLinkTitle','p.PropertyTitleAr AS PropertyTitle','p.DescriptionAr AS Description','p.NoBedrooms','p.NoBathrooms','p.UnitBuiltupArea','p.PlotSize','c.CityNameAr AS CityName','pc.CatergoryName','pu.TypeNameAr AS TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameAr AS ImgAlt','cs.CommunityNameAr AS CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.PluralAr AS Plural']);
        }
                $query->from('properties as p')
                ->join('cities as c', 'c.ID', '=', 'p.CityID')
                ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
                ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
                ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
                ->leftJoin('propety_agents as pa', 'pa.ID', '=', 'p.AgentID');
                //->leftJoin('property_images as pi','pi.PropertyID','=','p.ID');
                $query->leftJoin('property_images as pi', function ($join) {
                    $join->on('p.ID', '=', 'pi.PropertyID')
                         ->where('pi.IsThumbnail',0)
                         ->where('pi.IsDownloaded',1);
                });
      
            $query->where('p.IsEnable',1);
            $query->where('p.IsFeatured',1);
            $query->groupBy('p.PropertyRefNo');
            if($Orderby)
            {
                $query->orderBy($Orderby,$OrderSeq[$request->odr]);
            }else
            {
                $query->orderBy("p.PropertyRefNo","desc");
            }
            $Data=new \stdClass();
            $Data->Count=$query->get()->count();
            $Data->Result=$query->paginate(10);


            $meta="pages";

        return view('web-layouts.properties.list-featured', compact('Data','item','meta','AdTypeText'));
    }

    public function ShowExclusive(Request $request)
    {   
        $item = new \stdClass();
        $query= Property::query();
        $AdTypeText=[];
        $OrderCloumn=['new'=>'p.PropertyRefNo','old'=>'p.PropertyRefNo','p-asc'=>'p.Price','p-desc'=>'p.price'];
        $OrderSeq=['new'=>'desc','old'=>'asc','p-asc'=>'asc','p-desc'=>'desc'];
        $Orderby=($request->odr)?$OrderCloumn[$request->odr]:"";
        if(app()->getLocale()=="en")
        {
           
    
            $item->MetaTitle='Exclusive properties in amman at Homes real estate agency';
            $item->MetaDescription='High end residential and commercial properties in jordan listed only with Homes';
        
            $AdTypeText=config('constants.AdTypeRev');
           
            $query->select(['p.*','p.PropertyTitle AS PropertyLinkTitle','c.CityName','pc.CatergoryName','pu.TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameEn AS ImgAlt','cs.CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.Plural AS Plural']);
        }else{
           
          
            $item->MetaTitle='عقارات حصرية لدى شركة هومز';
            $item->MetaDescription='عقارات سكنية وتجارية مسوقة حصرية لدى هومز لتسويق وإدارة العقارات في عمان الأردن';
           
            $AdTypeText=config('constants.AdTypeRevAr');
            $query->select(['p.Guid','p.AdType','p.SlugAr AS Slug','p.PropertyRefNo','p.Price','p.PropertyTitle AS PropertyLinkTitle','p.PropertyTitleAr AS PropertyTitle','p.DescriptionAr AS Description','p.NoBedrooms','p.NoBathrooms','p.UnitBuiltupArea','p.PlotSize','c.CityNameAr AS CityName','pc.CatergoryName','pu.TypeNameAr AS TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameAr AS ImgAlt','cs.CommunityNameAr AS CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.PluralAr AS Plural']);
        }
                $query->from('properties as p')
                ->join('cities as c', 'c.ID', '=', 'p.CityID')
                ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
                ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
                ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
                ->leftJoin('propety_agents as pa', 'pa.ID', '=', 'p.AgentID');
                //->leftJoin('property_images as pi','pi.PropertyID','=','p.ID');
                $query->leftJoin('property_images as pi', function ($join) {
                    $join->on('p.ID', '=', 'pi.PropertyID')
                         ->where('pi.IsThumbnail',0)
                         ->where('pi.IsDownloaded',1);
                });
      
            $query->where('p.IsEnable',1);
            $query->where('p.IsExclusive',1);
            $query->groupBy('p.PropertyRefNo');
            if($Orderby)
            {
                $query->orderBy($Orderby,$OrderSeq[$request->odr]);
            }else
            {
                $query->orderBy("p.PropertyRefNo","desc");
            }
            $Data=new \stdClass();
            $Data->Count=$query->get()->count();
            $Data->Result=$query->paginate(10);


            $meta="pages";

        return view('web-layouts.properties.list-exclusive', compact('Data','item','meta','AdTypeText'));
    }


    public function showEvaluationForm()
    {
    
        $item = new \stdClass();
        if(app()->getLocale()=="en")
        {
            $item->MetaTitle='Property evaluation made simple with experts at Homes real estate';
            $item->MetaDescription='At Homes Jordan we are certified to provide our clients with a qualified evaluation report for their real estate property based on their requirements.';
        }else{
            $item->MetaTitle='تقييم العقارات أصبح بسيطً مع الخبراء هومز العقارية';
            $item->MetaDescription='خبراء هومز الاردن معتمدون لتزويد عملائنا بتقرير لتقييم لممتلكاتهم العقارية بناءً على متطلباتهم';
        }
        $meta="pages";
        $propertype=DB::table('evaluation_propertytype')->where('IsEnable',1)->get();
        foreach($propertype as $val)
        {
            $val->category=DB::table('evaluation_category')->where('IsEnable',1)->where('TypeId',$val->ID)->get();
        }
        $city=DB::table('evaluation_city')->where('IsEnable',1)->get();
        $category=DB::table('evaluation_category')->where('IsEnable',1)->get(['Guid AS Token','Price']);

        return view('web-layouts.properties.evaluation-form',compact('item','meta','propertype','city','category'));



    }

    public function storeEvaluationForm(Request $request)
    {

        $validatedData = $request->validate([
            'Name' => 'required',
            'Mobile' => 'required',
            //'Email' => 'required',
            //'Message'  => 'required',
            'g-recaptcha-response' => 'recaptcha',
        ],[
          'g-recaptcha-response.recaptcha' => 'Invalid recaptcha',
         
      ]);
        $input = $request->all();
        $contactinfo = ContactInfo::first();
        $catergoryGuid=$input['Category'];
        $category=DB::table('evaluation_category')->where('Guid',$catergoryGuid)->get(['Name','Price']);
        if($category)
        {
         $Maildata=[
        'Guid'=>(string) Str::uuid(),
        'Name'=>$input['Name'],
        'Email'=>(isset($input['Email']))? $input['Email'] : "",
        'Mobile'=>$input['Mobile'],
        'Category'=>$category[0]->Name,
        'Price'=>$category[0]->Price,
        'Area'=>$input['Area'],
        'City'=>$input['City'],
        'Purpose'=>(isset($input['Message']))? $input['Message']: "",
        ];
          if($contactinfo &&  $contactinfo->Email)
          {
            DB::table('evaluation_enquiries')->insert($Maildata);
            
             Mail::to($contactinfo->Email,'Team Homes')
             ->cc('omar@homes-jordan.com')
             ->send(new RequestEvaluation($Maildata));
    
            if (Mail::failures()) {
          
                return redirect()->back()->with('error','Error,while sending request.');
            }
            return redirect()->back()->with('success','Thank you, we have received your request. One of our agents will contact you shortly.');
         }else{

                return redirect()->back()->with('nodata','Error,no data found.');
            } 

        }else{


            return redirect()->back()->with('nodata','Error,no data found.');  
        }
        


    }

    public function ShowAllSale($Lang=null,$property_slug=NULL,Request $request)
    {   
      
        $item = new \stdClass();
        $query= Property::query();
        $AdTypeText=[];
        $OrderCloumn=['new'=>'p.PropertyRefNo','old'=>'p.PropertyRefNo','p-asc'=>'p.Price','p-desc'=>'p.price'];
        $OrderSeq=['new'=>'desc','old'=>'asc','p-asc'=>'asc','p-desc'=>'desc'];
        $Orderby=($request->odr)?$OrderCloumn[$request->odr]:"";
        $UnitType=PropertyUnitTypes::where('Slug',$property_slug)->first();
        if($UnitType)
        {

        
        if(app()->getLocale()=="en")
        {
           
           
            $item->MetaTitle=Str::ucfirst(strtolower('Search top '.$UnitType->TypeName.' properties for sale in Amman Jordan'));
            $item->MetaDescription='Top brokerage agency for selling & buying properties. Best listings for sale: villas, apartments, offices, showrooms, buildings, and lands in Amman Jordan';
            $AdTypeText=config('constants.AdTypeRev');
           
         $query->select(['p.*','p.PropertyTitle AS PropertyLinkTitle','c.CityName','pc.CatergoryName','pu.TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameEn AS ImgAlt','cs.CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.Plural AS Plural']);
        }else{
           
            $item->MetaTitle='ابحث عن عقارات سكنية وتجارية للبيع في عمان الأردن';
            $item->MetaDescription='أفضل شركة تسويق ووساطة عقارية لبيع وشراء العقارات. أفضل عروض لبيع: الفلل ، الشقق ، المكاتب ، المعارض ، المجمعات ، والأراضي  في عمان الأردن';
            
            $AdTypeText=config('constants.AdTypeRevAr');
            $query->select(['p.Guid','p.AdType','p.SlugAr AS Slug','p.PropertyRefNo','p.Price','p.PropertyTitle AS PropertyLinkTitle','p.PropertyTitleAr AS PropertyTitle','p.DescriptionAr AS Description','p.NoBedrooms','p.NoBathrooms','p.UnitBuiltupArea','p.PlotSize','c.CityNameAr AS CityName','pc.CatergoryName','pu.TypeNameAr AS TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameAr AS ImgAlt','cs.CommunityNameAr AS CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.PluralAr AS Plural']);
        }

        
                $query->from('properties as p')
                ->join('cities as c', 'c.ID', '=', 'p.CityID')
                ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
                ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
                ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
                ->leftJoin('propety_agents as pa', 'pa.ID', '=', 'p.AgentID');
                //->leftJoin('property_images as pi','pi.PropertyID','=','p.ID');
                $query->leftJoin('property_images as pi', function ($join) {
                    $join->on('p.ID', '=', 'pi.PropertyID')
                         ->where('pi.IsThumbnail',0)
                         ->where('pi.IsDownloaded',1);
                });
      
            $query->where('p.IsEnable',1);
            $query->where('p.AdType',2);
            if($UnitType){
                $query->where('p.UnitTypeID',$UnitType->ID);     
            }
            $query->groupBy('p.PropertyRefNo');
            if($Orderby)
            {
                $query->orderBy($Orderby,$OrderSeq[$request->odr]);
            }else
            {
                $query->orderBy("p.PropertyRefNo","desc");
            }
            $Data=new \stdClass();
            $Data->Count=$query->get()->count();
            $Data->Result=$query->paginate(21);
            if(app()->getLocale()=="en")
            {
            $Data->City=Cities::join('properties', 'cities.ID', '=', 'properties.CityID')
                                 ->where('cities.IsEnable',1)
                                 ->groupBy('cities.ID')
                                 ->orderBy('cities.CityName','asc')
                                 ->get(['cities.ID','cities.CityName','cities.CityName AS CityNameEng']);
           
                $Data->Locations=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                ->where('communities.IsEnable',1)
                ->groupBy('communities.ID')
                ->orderBy('communities.CommunityName','asc')
                ->get(['communities.ID','communities.CityID','communities.CommunityName']); 
                              
           

            $Data->PropertyUnitTypes=PropertyUnitTypes::join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
            ->where('property_unit_types.IsEnable',1)
            ->groupBy('property_unit_types.ID')
            ->get(['property_unit_types.ID','property_unit_types.FilterDivId','property_unit_types.TypeName','property_unit_types.TypeName AS TypeNameEng']);
            }else{
                $Data->City=Cities::join('properties', 'cities.ID', '=', 'properties.CityID')
                                 ->where('cities.IsEnable',1)
                                 ->groupBy('cities.ID')
                                 ->orderBy('cities.CityName','asc')
                                 ->get(['cities.ID','cities.CityNameAr AS CityName','cities.CityName AS CityNameEng']);
            

                $Data->Locations=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                ->where('communities.IsEnable',1)
                ->groupBy('communities.ID')
                ->orderBy('communities.CommunityName','asc')
                ->get(['communities.ID','communities.CityID','communities.CommunityNameAr AS CommunityName']);

                              
           

            $Data->PropertyUnitTypes=PropertyUnitTypes::join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
            ->where('property_unit_types.IsEnable',1)
            ->groupBy('property_unit_types.ID')
            ->get(['property_unit_types.ID','property_unit_types.FilterDivId','property_unit_types.TypeNameAr AS TypeName','property_unit_types.TypeName AS TypeNameEng']);


            }

        }else{
            abort(404);
        }

        $meta="pages";

        return view('web-layouts.properties.list-all-sale', compact('Data','item','meta','AdTypeText','UnitType'));
    }
    

    public function ShowAllRent($Lang=null,$property_slug=NULL,Request $request)
    {   
        $item = new \stdClass();
        $query= Property::query();
        $AdTypeText=[];
        $OrderCloumn=['new'=>'p.PropertyRefNo','old'=>'p.PropertyRefNo','p-asc'=>'p.Price','p-desc'=>'p.price'];
        $OrderSeq=['new'=>'desc','old'=>'asc','p-asc'=>'asc','p-desc'=>'desc'];
        $Orderby=($request->odr)?$OrderCloumn[$request->odr]:"";
        $UnitType=PropertyUnitTypes::where('Slug',$property_slug)->first();
        if($UnitType)
        {
        if(app()->getLocale()=="en")
        {     
                
                $item->MetaTitle=ucfirst(strtolower($UnitType->TypeName.'properties for rent in Amman Jordan'));
                 $item->MetaDescription='Specialized real estate agents & marketing experts in Rental properties & prime listings in Dabouq, Abdoun, Dair Ghbar, & other communities in Amman Jordan';
            
            $AdTypeText=config('constants.AdTypeRev');
           
         $query->select(['p.*','p.PropertyTitle AS PropertyLinkTitle','c.CityName','pc.CatergoryName','pu.TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameEn AS ImgAlt','cs.CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.Plural AS Plural']);
        }else{
               
                $item->MetaTitle='شقق وفلل وأراضي وعقارات تجارية للإيجار في عمان الأردن';
                $item->MetaDescription='وسطاء عقاريين مختصين وخبراء تسويق في تأجير العقارات والعروض المميزة في دابوق وعبدون وديرغبار ومناطق أخرى في غرب عمان الأردن';
           
            $AdTypeText=config('constants.AdTypeRevAr');
            $query->select(['p.Guid','p.AdType','p.SlugAr AS Slug','p.PropertyRefNo','p.Price','p.PropertyTitle AS PropertyLinkTitle','p.PropertyTitleAr AS PropertyTitle','p.DescriptionAr AS Description','p.NoBedrooms','p.NoBathrooms','p.UnitBuiltupArea','p.PlotSize','c.CityNameAr AS CityName','pc.CatergoryName','pu.TypeNameAr AS TypeName','pi.FileName','pi.IsDownloaded','pi.ImageNameAr AS ImgAlt','cs.CommunityNameAr AS CommunityName','pa.DisplayPhone','pa.DisplayEmail','pu.CardViewFields','pa.PluralAr AS Plural']);
        }

        
                $query->from('properties as p')
                ->join('cities as c', 'c.ID', '=', 'p.CityID')
                ->join('communities as cs', 'cs.ID', '=', 'p.CommunityID')
                ->join('propety_categories as pc', 'pc.ID','=','p.CategoryID')
                ->join('property_unit_types as pu', 'pu.ID', '=', 'p.UnitTypeID')
                ->leftJoin('propety_agents as pa', 'pa.ID', '=', 'p.AgentID');
                //->leftJoin('property_images as pi','pi.PropertyID','=','p.ID');
                $query->leftJoin('property_images as pi', function ($join) {
                    $join->on('p.ID', '=', 'pi.PropertyID')
                         ->where('pi.IsThumbnail',0)
                         ->where('pi.IsDownloaded',1);
                });
      
            $query->where('p.IsEnable',1);
            $query->where('p.AdType',1);
            if($UnitType){
                $query->where('p.UnitTypeID',$UnitType->ID);     
            }
            $query->groupBy('p.PropertyRefNo');
            if($Orderby)
            {
                $query->orderBy($Orderby,$OrderSeq[$request->odr]);
            }else
            {
                $query->orderBy("p.PropertyRefNo","desc");
            }
            $Data=new \stdClass();
            $Data->Count=$query->get()->count();
            $Data->Result=$query->paginate(21);
            if(app()->getLocale()=="en")
            {
            $Data->City=Cities::join('properties', 'cities.ID', '=', 'properties.CityID')
                                 ->where('cities.IsEnable',1)
                                 ->groupBy('cities.ID')
                                 ->orderBy('cities.CityName','asc')
                                 ->get(['cities.ID','cities.CityName','cities.CityName AS CityNameEng']);
           
                $Data->Locations=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                ->where('communities.IsEnable',1)
                ->groupBy('communities.ID')
                ->orderBy('communities.CommunityName','asc')
                ->get(['communities.ID','communities.CityID','communities.CommunityName']); 
                              
           

            $Data->PropertyUnitTypes=PropertyUnitTypes::join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
            ->where('property_unit_types.IsEnable',1)
            ->groupBy('property_unit_types.ID')
            ->get(['property_unit_types.ID','property_unit_types.FilterDivId','property_unit_types.TypeName','property_unit_types.TypeName AS TypeNameEng']);
            }else{
                $Data->City=Cities::join('properties', 'cities.ID', '=', 'properties.CityID')
                                 ->where('cities.IsEnable',1)
                                 ->groupBy('cities.ID')
                                 ->orderBy('cities.CityName','asc')
                                 ->get(['cities.ID','cities.CityNameAr AS CityName','cities.CityName AS CityNameEng']);
            

                $Data->Locations=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                ->where('communities.IsEnable',1)
                ->groupBy('communities.ID')
                ->orderBy('communities.CommunityName','asc')
                ->get(['communities.ID','communities.CityID','communities.CommunityNameAr AS CommunityName']);

                              
           

            $Data->PropertyUnitTypes=PropertyUnitTypes::join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
            ->where('property_unit_types.IsEnable',1)
            ->groupBy('property_unit_types.ID')
            ->get(['property_unit_types.ID','property_unit_types.FilterDivId','property_unit_types.TypeNameAr AS TypeName','property_unit_types.TypeName AS TypeNameEng']);


            }
        }else{
            abort(404);
        }

            $meta="pages";

        return view('web-layouts.properties.list-all-rent', compact('Data','item','meta','AdTypeText','UnitType'));
    }
    
}