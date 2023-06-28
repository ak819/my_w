<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\CronInfo;
use PhpParser\Node\Stmt\TryCatch;

set_time_limit(0);
class PropertyCrawler extends Controller
{
    public function index()
    {  
        
        
        //     $Storagepath=Storage::disk('public_uploads');
        //    $xmlfile = $Storagepath->get('8807.xml');
        //   $XMLDoc= simplexml_load_string($xmlfile);
        // $XMLArray = json_decode(json_encode((array)$XMLDoc), TRUE);

        // echo "<pre>";
        // print_r($XMLArray);
        // exit;
       
        $start_time = microtime(true);

        $Crondata=['DeletedCount'=>0];
        $CronAnalysisID=DB::table('cronanalysis')->insertGetId($Crondata);
        
          $xmlurl = "http://mexml.propspace.com/mefeed/xml.php?cl=1061&pid=8245&acc=8807"; 
         //$xmlurl="http://mexml.propspace.com/mefeed/xml.php?cl=1061&pid=8782&acc=8781";
         //$xmlurl="http://mexml.propspace.com/mefeed/xml.php?cl=1061&pid=11001&acc=11100";
            $curl = curl_init($xmlurl);
            curl_setopt($curl, CURLOPT_URL, $xmlurl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $XMLDoc = simplexml_load_string(curl_exec($curl));
            curl_close($curl);
            $XMLArray = json_decode(json_encode((array)$XMLDoc), TRUE); // converting array of object to array
            $ALL_Property_Ref_No=array_column($XMLArray['Listing'],'Property_Ref_No'); // getting all Property_Ref_No from array
            DB::table('properties')->whereNotIn('PropertyRefNo', $ALL_Property_Ref_No)->update(['IsEnable'=>0]);
            
            // $CountryID=1;

            // echo "<pre>";
            // print_r($XMLArray);
            // exit;
            
        
          
          
          $i=1;
       
        
        foreach($XMLDoc->Listing as $Record)
        { 
            $PropertyID=$PropertyRefNo=$LastUpdate="";
            $CountryID=1;
             //echo "<pre>";
             //print_r($Record);
            //  exit;
            // city start //
            $CityName=$Record->City;
            $CityID="";
            $City=DB::table('cities')->where("CityName", $CityName)->first();
            if($City)
            {
             $CityID=$City->ID;
            }else{
            $data=['Guid'=>(string) Str::uuid(),'CityName'=>$CityName,'CountryID'=>$CountryID,'IsEnable'=>1];
            $CityID=DB::table('cities')->insertGetId($data);
            }
            // city end //

             //communities start //
             $CommunityName=$Record->Community;
             $CommunityID="";
             $Community=DB::table('communities')->where("CommunityName", $CommunityName)->first();
             if($Community)
             {
              $CommunityID=$Community->ID;
             }else{
             $data=['Guid'=>(string) Str::uuid(),'CommunityName'=>$CommunityName,'CityID'=>$CityID,'IsEnable'=>1];
             $CommunityID=DB::table('communities')->insertGetId($data);
             }
             //communities end//

             //Propety Category start //
             $CatergoryName=$Record->Category;
             $CategoryID="";
             $Category=DB::table('propety_categories')->where("CatergoryName", $CatergoryName)->first();
             if($Category)
             {
              $CategoryID=$Category->ID;
             }else{
             $data=['Guid'=>(string) Str::uuid(),'CatergoryName'=>$CatergoryName,'IsEnable'=>1];
             $CategoryID=DB::table('propety_categories')->insertGetId($data);
             }
             //Propety Category end//

            // Propety Unit Type start //
             $UnitTypeName=$Record->Unit_Type;
             $UnitTypeID="";
             $UnitType=DB::table('property_unit_types')->where("TypeName", $UnitTypeName)->first();
             if($UnitType)
             {
              $UnitTypeID=$UnitType->ID;
             }else{
             $data=['Guid'=>(string) Str::uuid(),'CategoryID'=>$CategoryID,'TypeName'=>$UnitTypeName,'IsEnable'=>1];
             $UnitTypeID=DB::table('property_unit_types')->insertGetId($data);
             }
             // Propety Unit Type end //

             // Propety Agent start //
             $AgentName=$Record->Listing_Agent;
             $AgentEmail=$Record->Listing_Agent_Email;
             $AgentPhone=$Record->Listing_Agent_Phone;
             $AgentPhoto=$Record->Listing_Agent_Photo;
             $AgentID="";
             $Agent=DB::table('propety_agents')->where("Name", $AgentName)->first();
             if($Agent)
             {
              $AgentID=$Agent->ID;
             }else{
             $data=['Guid'=>(string) Str::uuid(),'Name'=>$AgentName,'Email'=>$AgentEmail,'Phone'=>$AgentPhone,'Photo'=>$AgentPhoto,'IsEnable'=>1];
             $AgentID=DB::table('propety_agents')->insertGetId($data);
             }
            // Propety Agent end //

            // Propety  start //
           
             $PropertyRefNo=trim($Record->Property_Ref_No);
             $LastUpdate=date('Y-m-d H:i:s', strtotime($Record->Last_Updated));
             $Propety=DB::table('properties')->where("PropertyRefNo",$PropertyRefNo)->first();
             /* if property ref no found then go for update if lastupdate date greater than old one */
            
             
             if(empty(!$Propety) && $Propety->ID!==" ")
             {

                 
                $PropertyID=$Propety->ID; 
               //if(strtotime($LastUpdate) > strtotime($Propety->CRMLastUpdateDate))
                //{
                    $AdType=trim($Record->Ad_Type);
                    $AdType=config('constants.AdType.'.$AdType);
                    $PropertyTitle=$Record->Property_Title;
                    $PropertyTitleAr=$Record->Property_Title_Ar;
                     $data=[
                    'CategoryID'=>$CategoryID,
                    'UnitTypeID'=>$UnitTypeID,
                    'CityID'=>$CityID,
                    'CommunityID'=>$CommunityID,
                    'AgentID'=>$AgentID,
                    'AdType'=> $AdType,
                    'PropertyTitle'=>$PropertyTitle,
                    'PropertyTitleAr'=>$Record->Property_Title_Ar,
                    'Description'=>$Record->Web_Remarks,
                    'DescriptionAr'=>$Record->Web_Remarks_Ar,
                    'Price'=>$Record->Price,
                    'NoRooms'=>$Record->No_of_Rooms,
                    'NoBedrooms'=>$Record->Bedrooms,
                    'NoBathrooms'=>$Record->No_of_Bathroom,
                    'UnitBuiltupArea'=>$Record->Unit_Builtup_Area,
                    'UnitMeasure'=>$Record->unit_measure,
                    'Featured'=>$Record->Featured,
                    'Exclusive'=>$Record->Exclusive,
                    'Tenanted'=>$Record->Tenanted,
                    'Furnished'=>$Record->Furnished,
                    'UnitModel'=>$Record->Unit_Model,
                    'PrimaryView'=>$Record->Primary_View,
                    'RentFrequency'=>$Record->Plot_Size,
                    'PlotSize'=>$Record->Plot_Size,
                    'Parking'=>$Record->company_name,
                    'CompanyName'=>$Record->company_name,
                    'CompanyLogo'=>$Record->company_logo,
                    'CRMLastUpdateDate'=>date('Y-m-d H:i:s', strtotime($Record->Last_Updated)),
                    'IsEnable'=>1,
                    'IsCronLastUpdated'=>1];
                     DB::table('properties')->where('ID',$PropertyID)->update($data);
                                      //echo "<pre>";
                // echo "updating === ".$PropertyID.'======'.$Record->Property_Ref_No;
                     $Images=$Record->Images->image;
                     $Thumbs=$Record->Thumb;
                     $res=$this->updatePropertyImages($Images,$Thumbs,$PropertyID,$PropertyRefNo);
               // }


             }else{
                
               
             $AdType=trim($Record->Ad_Type);
             $AdType=config('constants.AdType.'.$AdType);
             $PropertyTitle=$Record->Property_Title;
             $PropertyTitleAr=$Record->Property_Title_Ar;
             $data=['Guid'=>(string) Str::uuid(),
                    'CategoryID'=>$CategoryID,
                    'UnitTypeID'=>$UnitTypeID,
                    'CityID'=>$CityID,
                    'CommunityID'=>$CommunityID,
                    'AgentID'=>$AgentID,
                    'PropertyRefNo'=>$Record->Property_Ref_No,
                    'AdType'=> $AdType,
                    'PropertyTitle'=>$PropertyTitle,
                    'PropertyTitleAr'=>$Record->Property_Title_Ar,
                    'Description'=>$Record->Web_Remarks,
                    'DescriptionAr'=>$Record->Web_Remarks_Ar,
                    'Price'=>$Record->Price,
                    'NoRooms'=>$Record->No_of_Rooms,
                    'NoBedrooms'=>$Record->Bedrooms,
                    'NoBathrooms'=>$Record->No_of_Bathroom,
                    'UnitBuiltupArea'=>$Record->Unit_Builtup_Area,
                    'UnitMeasure'=>$Record->unit_measure,
                    'Featured'=>$Record->Featured,
                    'Exclusive'=>$Record->Exclusive,
                    'Tenanted'=>$Record->Tenanted,
                    'Furnished'=>$Record->Furnished,
                    'UnitModel'=>$Record->Unit_Model,
                    'PrimaryView'=>$Record->Primary_View,
                    'RentFrequency'=>$Record->Plot_Size,
                    'PlotSize'=>$Record->Plot_Size,
                    'Parking'=>$Record->company_name,
                    'CompanyName'=>$Record->company_name,
                    'CompanyLogo'=>$Record->company_logo,
                    'CRMLastUpdateDate'=>date('Y-m-d H:i:s', strtotime($Record->Last_Updated)),
                    'IsEnable'=>1,];
                     $PropertyID=DB::table('properties')->insertGetId($data);
                     
                     // echo "<pre>";
                     //echo "inserted === ".$PropertyID.'======'.$Record->Property_Ref_No;;
                 
                     $Images=$Record->Images->image;
                     $Thumbs=$Record->Thumb;
                     $res=$this->addPropertyImages($Images,$Thumbs,$PropertyID,$PropertyRefNo,$PropertyTitle,$PropertyTitleAr);

             }
              
             
          
        //       if($i==5)
        //      {
        //       $ToBeDeleted=DB::table('properties')->select('count(*) as allcount')->where('IsEnable',0)->count();
        //      $this->deletePropertyData();
        //      $this->downloadAllPropertyImages(); 
        //      $end_time = microtime(true);
        //   // Calculate script execution time
        //   $execution_time = ($end_time - $start_time);
        //   $Crondata=['ExecutionTime'=> $execution_time,'TotalPropertyProcess'=>$i,'DeletedCount'=>$ToBeDeleted];
        //   DB::table('cronanalysis')->where('ID',$CronAnalysisID)->update($Crondata);
        //        exit;
            
        //      }

          

            $i++; 
        }
       
       $ToBeDeleted=DB::table('properties')->select('count(*) as allcount')->where('IsEnable',0)->count();
       $this->deletePropertyData();
       $this->downloadAllPropertyImages(); 
       $end_time = microtime(true);
          // Calculate script execution time
       $execution_time = ($end_time - $start_time);
       $Crondata=['ExecutionTime'=> $execution_time,'TotalPropertyProcess'=>$i,'DeletedCount'=>$ToBeDeleted];
       DB::table('cronanalysis')->where('ID',$CronAnalysisID)->update($Crondata);
       $this->sendmail($execution_time);
       
    }

    public function addPropertyImages($Images,$Thumbs,$PropertyID,$PropertyReFNo,$PropertyTitle,$PropertyTitleAr)
    {
       if($Images)
       {   
           foreach($Images as $Imgurl)
           { 
            if($Imgurl){
            $extension = pathinfo($Imgurl, PATHINFO_EXTENSION);
            $Filename=strtotime("now").'_'.(string) Str::uuid().'.'.$extension;
            //$Storagepath=Storage::disk('public_uploads');
            //$FilePath = 'properties/orignal/'.$PropertyReFNo.'/'.$Filename;
            //$Storagepath->put($FilePath,file_get_contents($Imgurl));
            $data=['Guid'=>(string) Str::uuid(),'PropertyID'=>$PropertyID,'ImageUrl'=>$Imgurl,'ImageNameEn'=>$PropertyTitle,'ImageNameAr'=>$PropertyTitleAr,'FileName'=>$Filename,'IsEnable'=>1];
            DB::table('property_images')->insert($data);
           }
         }
        
       }
       if($Thumbs)
       {
           foreach($Thumbs as $Imgurl)
           {
            if($Imgurl){
            $extension = pathinfo($Imgurl, PATHINFO_EXTENSION);
            $Filename=strtotime("now").'_'.(string) Str::uuid().'.'.$extension;
           // $Storagepath=Storage::disk('public_uploads');
            //$FilePath = 'properties/thumb/'.$PropertyReFNo.'/'.$Filename;
           // $Storagepath->put($FilePath,file_get_contents($Imgurl));
            $data=['Guid'=>(string) Str::uuid(),'PropertyID'=>$PropertyID,'ImageUrl'=>$Imgurl,'ImageNameEn'=>$PropertyTitle,'ImageNameAr'=>$PropertyTitleAr,'FileName'=>$Filename,'IsThumbnail'=>'1','IsEnable'=>1];
            DB::table('property_images')->insert($data);
            }
           }
        
       }
       return 1;
        


    }

    public function updatePropertyImages($Images,$Thumbs,$PropertyID,$PropertyReFNo)
    {
        ///////////////////////////// property Images ////////////////////////////////////////////
        $PropertyImages=DB::table('property_images')
                            ->where('PropertyID',$PropertyID)
                            ->where('IsThumbnail',0)
                            ->where('IsByAdmin',0)
                            ->get();
        $PropertyImagesArray = json_decode(json_encode($PropertyImages), true);
        $PropertyImagesUrls=array_column($PropertyImagesArray,'ImageUrl');
        $PropertyImagesNames=array_column($PropertyImagesArray,'FileName');
        $PropertyImagesIds=array_column($PropertyImagesArray,'ID');
        $AvailableUrls=array();
        if($Images)
       {
           foreach($Images as $Imgurl)
           {
             if($Imgurl){
           
            $extension = pathinfo($Imgurl, PATHINFO_EXTENSION);
            $Filename=strtotime("now").'_'.(string) Str::uuid().'.'.$extension;
            $AvailableUrls[]=$Imgurl;
                if(!in_array($Imgurl, $PropertyImagesUrls))
                {
                    //$Storagepath=Storage::disk('public_uploads');
                    //$FilePath = 'properties/orignal/'.$PropertyReFNo.'/'.$Filename;
                   //$Storagepath->put($FilePath,file_get_contents($Imgurl));
                    $data=['Guid'=>(string) Str::uuid(),'PropertyID'=>$PropertyID,'ImageUrl'=>$Imgurl,'FileName'=>$Filename,'IsEnable'=>1];
                    DB::table('property_images')->insert($data);
                }
            }
           }
       }
       if($PropertyImagesUrls) // if database images count greater than crawler images then taking only available form crawler
       {
        $i=0;
        foreach($PropertyImagesUrls as $Imgurl)
        {
         if(!in_array($Imgurl, $AvailableUrls))
         {
             //$Storagepath=Storage::disk('public_uploads');
             //$FilePath = 'properties/orignal/'.$PropertyReFNo.'/'.$PropertyImagesNames[$i];
             //$Storagepath->delete($FilePath);
             //DB::table('property_images')->where('ID', $PropertyImagesIds[$i])->delete();

             $data=['IsToBeDeleted'=>1];
             DB::table('property_images')->where('ID',$PropertyImagesIds[$i])->update($data);

             
         }
        $i++; 
        }

       }
        ///////////////////////////// property thumbs ////////////////////////////////////////////
         $PropertyThumbs=DB::table('property_images')
                            ->where('PropertyID',$PropertyID)
                            ->where('IsThumbnail',1)
                            ->where('IsByAdmin',0)
                            ->get();
        $PropertyThumbsArray = json_decode(json_encode($PropertyThumbs), true);
        $PropertyThumbsNames=array_column($PropertyThumbsArray,'FileName');
        $PropertyThumbsUrls=array_column($PropertyThumbsArray,'ImageUrl');
        $PropertyThumbsIds=array_column($PropertyThumbsArray,'ID');
        $AvailableThumbUrls=array();
        if($Thumbs)
       {
           foreach($Thumbs as $Imgurl)
           {
           
            if($Imgurl){
            $extension = pathinfo($Imgurl, PATHINFO_EXTENSION);
            $Filename=strtotime("now").'_'.(string) Str::uuid().'.'.$extension;
            $AvailableThumbUrls[]=$Imgurl;
            if(!in_array($Imgurl, $PropertyThumbsUrls))
            {
                //$Storagepath=Storage::disk('public_uploads');
                //$FilePath = 'properties/thumb/'.$PropertyReFNo.'/'.$Filename;
               //$Storagepath->put($FilePath,file_get_contents($Imgurl));
                $data=['Guid'=>(string) Str::uuid(),'PropertyID'=>$PropertyID,'ImageUrl'=>$Imgurl,'FileName'=>$Filename,'IsThumbnail'=>'1','IsEnable'=>1];
                DB::table('property_images')->insert($data);
            }
            }
           }  
       }
       if($PropertyThumbsUrls) // if database thumbs count greater than crawler images then taking only available form crawler
       {
        $i=0;
        foreach($PropertyThumbsUrls as $Imgurl)
        {
         if(!in_array($Imgurl, $AvailableThumbUrls))
         {
            //  $Storagepath=Storage::disk('public_uploads');
            //  $FilePath = 'properties/thumb/'.$PropertyReFNo.'/'.$PropertyThumbsNames[$i];
            //  $Storagepath->delete($FilePath);
            //  DB::table('property_images')->where('ID', $PropertyThumbsIds[$i])->delete();
            $data=['IsToBeDeleted'=>1];
            DB::table('property_images')->where('ID',$PropertyThumbsIds[$i])->update($data);
         }
        $i++; 
        }

       }
       return 1;

    }
    
    
    public function deletePropertyData()
   {
    $DisabledProperty=DB::table('properties')->where("IsEnable",0)->get();
     if($DisabledProperty){
        
            DB::transaction(function() use ($DisabledProperty) {
                foreach($DisabledProperty as $val)
                {
                DB::table('property_images')->where('PropertyID',$val->ID)->delete();
                DB::table('properties')->where('ID',$val->ID)->delete();
                $Storagepath=Storage::disk('public_uploads');
                $OrignalFilePath = 'properties/orignal/'.$val->PropertyRefNo;
                $ThumnbFilePath = 'properties/thumb/'.$val->PropertyRefNo;
                $Storagepath->deleteDirectory($OrignalFilePath);
                $Storagepath->deleteDirectory($ThumnbFilePath);
               }
            });
         
        
       
     }
     return true;
   
   }
   public function downloadAllPropertyImages()
   {

    $Images=DB::table('property_images')->select(['p.PropertyRefNo','pi.Guid','pi.FileName','pi.ImageUrl','pi.IsThumbnail'])
    ->from('property_images as pi')
    ->where('IsDownloaded',0)
    ->join('properties as p', 'p.ID', '=', 'pi.PropertyID')
    ->orderBy("p.PropertyRefNo","desc")
    ->get();
    
    if(empty(!$Images))
    {
       foreach($Images as $val)
       { 

           try {
                if($val->IsThumbnail==0)
                {       
                $Storagepath=Storage::disk('public_uploads');
                $FilePath = 'properties/orignal/'.trim($val->PropertyRefNo).'/'.trim($val->FileName);
                $Storagepath->put($FilePath,file_get_contents(trim($val->ImageUrl)));
                $data=['IsDownloaded'=>1];
                DB::table('property_images')->where('Guid',$val->Guid)->update($data);
                }else{
                $Storagepath=Storage::disk('public_uploads');
                $FilePath = 'properties/thumb/'.trim($val->PropertyRefNo).'/'.trim($val->FileName);
                $Storagepath->put($FilePath,file_get_contents(trim($val->ImageUrl)));
                $data=['IsDownloaded'=>1];
                DB::table('property_images')->where('Guid',$val->Guid)->update($data);
    
                }
           } catch (\Throwable $th) {

               //throw $th;
               continue;
           }
        
       }

    }
   
    // property images to be deleted if property having downloaded images
    $PropertyImagesToBeDeleted=DB::table('property_images')->select('PropertyID')
           ->where('IsToBeDeleted',1)
           ->groupBy('PropertyID')
           ->get();

           if($PropertyImagesToBeDeleted)
           { 
               foreach($PropertyImagesToBeDeleted as $val)
               {
                $HavingImagesCount=DB::table('property_images')->select('count(*) as allcount')
                 ->where('PropertyID',$val->PropertyID)
                 ->where('IsDownloaded',1)
                 ->where('IsToBeDeleted',0)
                 ->count();
                 if($HavingImagesCount > 1)
                 {
                    $Images=DB::table('property_images')->select(['p.PropertyRefNo','pi.Guid','pi.FileName','pi.ImageUrl','pi.IsThumbnail'])
                    ->from('property_images as pi')
                    //->where('IsDownloaded',1)
                    ->where('IsToBeDeleted',1)
                    ->where('PropertyID',$val->PropertyID)
                    ->join('properties as p', 'p.ID', '=', 'pi.PropertyID')
                    ->orderBy("p.PropertyRefNo","desc")
                    ->get();


                    DB::transaction(function() use ($Images) {
                        foreach($Images as $val)
                        {
                                if($val->IsThumbnail==0)
                                    {       
                                        $Storagepath=Storage::disk('public_uploads');
                                        $FilePath = 'properties/orignal/'.trim($val->PropertyRefNo).'/'.trim($val->FileName);
                                        $Storagepath->delete($FilePath);
                                        DB::table('property_images')->where('Guid', $val->Guid)->delete();
                                    }else{
                                   
                                        $Storagepath=Storage::disk('public_uploads');
                                        $FilePath = 'properties/thumb/'.trim($val->PropertyRefNo).'/'.trim($val->FileName);
                                        $Storagepath->delete($FilePath);
                                        DB::table('property_images')->where('Guid', $val->Guid)->delete();
                        
                                    }
                       }
                    });

                 }

               }
           }

        return true;

   }
   public function sendmail($execution_time)
    {
            
            $data=['msg'=>'cronjob runed successfully<br><br>Total execution time:'.$execution_time,'from'=>'agent@homes-jordan.com','name'=>'system'];
        
             Mail::to('akshay.chaudhari@nullplex.in','Team Homes')->send(new CronInfo($data));
    
            if (Mail::failures()) {
                
                return  false;
            }
            return true;
       
            
    }

    public function testupload()
    { 
        
        $Images = Array
        ('http://JO.propspace.com/watermark?c_id=1061&l_id=217062&aid=3014&id=16298870720864682&image=25_08_2021-13_37_35-1061-e72663b23cb838e3c5791a8fd3b5c966.jpeg',
         'http://JO.propspace.com/watermark?c_id=1061&l_id=217062&aid=3014&id=16298870720864682&image=25_08_2021-13_37_36-1061-2a84500d80a3a9ce226da698e22fc7a7.jpeg',
         'http://JO.propspace.com/watermark?c_id=1061&l_id=217062&aid=3014&id=16298870720864682&image=25_08_2021-13_37_38-1061-f5a1d0efef447e002e3b9a9ca50c7b90.jpeg',
         'http://JO.propspace.com/watermark?c_id=1061&l_id=217062&aid=3014&id=16298870720864682&image=25_08_2021-13_37_33-1061-25796e054320b2187f80eaaec5aa103c.jpeg',
         'http://JO.propspace.com/watermark?c_id=1061&l_id=217062&aid=3014&id=16298870720864682&image=25_08_2021-13_37_31-1061-4ff3ed20c4448da4ade13faca11fd08f.jpeg'          
        );

        foreach($Images as $img)
           {
            $url=$img;
            $Filearray=explode('&image=',$url);
            $Filename=$Filearray[1];
           
                $Storagepath=Storage::disk('public_uploads');
                $FilePath = 'properties/orignal/test/'.$Filename;
                $Storagepath->put($FilePath,file_get_contents($url));
           
            
           }
         exit;

    }
}