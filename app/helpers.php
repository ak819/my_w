<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Agents;
use App\Models\Cities;

if (! function_exists('datetime_format')) {
    function datetime_format($date)
    {
        return date('d/m/Y h:i A', strtotime($date));
    }
    
}
if (! function_exists('date_formats')) {
    function date_formats($date)
    {
        return date('d/m/Y', strtotime($date));
    }
    
}

if (! function_exists('currency_format')) {
    
    function currency_format($amount){
        $currency=session('currency');
        $currency_name=$currency[0];
        $currency_value=$currency[1];
        $amount= number_format($amount * $currency_value);
            return  $currency_name.' '.$amount;
        
    }
    
    
}


        if (! function_exists('getUserRoles')) {
            
            function getUserRoles()
            {
                return DB::table('userroles')->where("ID",'!=',1)->get();
                
            }
            
            
        }

    
    if (! function_exists('getPropertyAgentTypes')) {
            
    function getPropertyAgentTypes()
    {
        return  $list = Agents::where('IsEnable',1)->get();
        
    }
   }
   if (! function_exists('getLoggedInUserAgentTypes')) {
    function getLoggedInUserAgentTypes()
    {
        $userid=Auth::user()->id;
        $userAgentTypesResult=DB::table('useragenttype')->select('PropertyAgentID')->where("UserID",$userid)->get();
        $userAgentTypes = collect($userAgentTypesResult)->map(function($x){ return (array) $x; })->toArray(); 
        $userAgentTypesArray=array_column($userAgentTypes,'PropertyAgentID');
        return  $userAgentTypesArray;
    }
   }

   if (! function_exists('getLoggedInUserCities')) {
    function getLoggedInUserCities()
    {
        $userid=Auth::user()->id;
        $userCitiesResult=DB::table('usercities')->select('CityID')->where("UserID",$userid)->get();
        $userCities = collect($userCitiesResult)->map(function($x){ return (array) $x; })->toArray(); 
        $userCityArray=array_column($userCities,'CityID');
        return  $userCityArray;
    }
   }
   if (! function_exists('getLoggedInUserLocations')) {
    function getLoggedInUserLocations()
    {
        $userid=Auth::user()->id;
        $userlocationsResult=DB::table('userlocations')->select('CommunityID')->where("UserID",$userid)->get();
        $userlocations = collect($userlocationsResult)->map(function($x){ return (array) $x; })->toArray(); 
        $userlocationsArray=array_column($userlocations,'CommunityID');
        return  $userlocationsArray;
    }
   }

   if (! function_exists('getPropertyTypes')) {
    function getPropertyTypes()
    {
        return DB::table('property_unit_types')->where("IsEnable",1)->get();

    }
   }
   if (! function_exists('getCities')) {
    function getCities()
    {
        return Cities::join('properties', 'cities.ID', '=', 'properties.CityID')
        ->where('cities.IsEnable',1)
        ->groupBy('cities.ID')
        ->orderBy('cities.CityName','asc')
        ->get(['cities.ID','CityName']);

    }
   }

   if (! function_exists('closetags')) {
    function closetags($html) {
    preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedtags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedtags = $result[1];
    $len_opened = count($openedtags);
    if (count($closedtags) == $len_opened) {
        return $html;
    }
    $openedtags = array_reverse($openedtags);
    for ($i=0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)) {
            $html .= '</'.$openedtags[$i].'>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
    }
    return $html;
  } 
}

if (! function_exists('arabic_slug')) {
    function arabic_slug($string, $separator = '-') {
        if (is_null($string)) {
            return "";
        }
    
        // Remove spaces from the beginning and from the end of the string
        $string = trim($string);
    
        // Lower case everything
        // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: https://www.php.net/manual/en/function.mb-strtolower.php
        $string = mb_strtolower($string, "UTF-8");;
    
        // Make alphanumeric (removes all other characters)
        // this makes the string safe especially when used as a part of a URL
        // this keeps latin characters and arabic charactrs as well
        $string = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
    
        // Remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
    
        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);
    
        return $string;
    }
}

   /**
     * genrating slug
     *
     * $table for table name
     * $match for match field accordin to this we creating slug
     * name for slug text
    */

    function generateSlug($table,$match,$name)
    {
        if (DB::table($table)->whereSlug($slug = Str::slug($name))->exists()) {
            $max = DB::table($table)->where($match,'=',$name)->latest('id')->value('Slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
           // return "{$slug}-2";
           return "{$slug}";
        }
        return $slug;
    }
     function generateSlugAr($table,$match,$name)
    {
        if (DB::table($table)->where('SlugAr','=',$slug=arabic_slug($name))->exists()) {
            $max = DB::table($table)->where($match,'=',$name)->latest('id')->value('SlugAr');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
           // return "{$slug}-2";
           return "{$slug}";
        }
        return $slug;
    } 

     function findSlug($table,$lang,$slug)
    {

         $slug=urldecode($slug);
        if($lang=='ar')
        {
            return DB::table($table)->where('Slug','=',$slug)->value('SlugAr');
        }else{
            
            return DB::table($table)->where('SlugAr','=',$slug)->value('Slug');
        }

    }

    function findPropertySlug($table,$lang,$refno)
    {
        if($lang=='ar')
        {
            return DB::table('properties as p')->where('p.PropertyRefNo','=',$refno)
                        ->Join('propety_agents as pa', 'pa.ID', '=', 'p.AgentID')
                        ->get(['SlugAr AS Slug','pa.PluralAr AS Plural']);

        }else{
            
                return DB::table('properties as p')->where('p.PropertyRefNo','=',$refno)
                ->Join('propety_agents as pa', 'pa.ID', '=', 'p.AgentID')
                ->get(['Slug','Plural']);
        }

    }

    function multi_array_search($array, $search)
    {
  
      // Create the result array
      $result = array();
  
      // Iterate over each array element
      foreach ($array as $key => $value)
      {
  
        // Iterate over each search condition
        foreach ($search as $k => $v)
        {
  
          // If the array element does not meet the search condition then continue to the next element
          if (!isset($value[$k]) || $value[$k] != $v)
          {
            continue 2;
          }
  
        }
  
        // Add the array element's key to the result array
        $result[] = $key;
  
      }
  
      // Return the result array
      return $result;
  
    }

     function getPropertyMetaTitleDesc($lang,$adtype="",$unittype="",$city="Amman Jordan"){
        if($lang=="en")
        {
            if ($adtype==2) { // sale
                
                 $UnitName=strtolower(DB::table('property_unit_types')->where('ID',$unittype)->value('TypeName'));
                 if(is_numeric($city)){
                    $city=strtolower(DB::table('cities')->where('ID',$city)->value('CityName'));
                 }
                 return ['title'=>($UnitName)? "Search top ". $UnitName." for sale in ".$city : "Search top ". $UnitName."properties for sale in ".$city,
                        'desc'=>'Top brokerage agency for selling & buying properties. Best listings for sale: villas, apartments, offices, showrooms, buildings, and lands in Amman Jordan'];

               
              } elseif ($adtype==1) { // rent

                $UnitName=strtolower(DB::table('property_unit_types')->where('ID',$unittype)->value('TypeName'));
                if(is_numeric($city)){
                   $city=strtolower(DB::table('cities')->where('ID',$city)->value('CityName'));
                }
                return ['title'=>($UnitName)? $UnitName." for rent in ".$city : "properties for rent in ".$city,
                        'desc'=>'Specialized real estate agents & marketing experts in Rental properties & prime listings in Dabouq, Abdoun, Dair Ghbar, & other communities in Amman Jordan'];
               
              } else { // default

                return ['title'=>"properties for sale and rent in ".$city,
                         'desc'=>"properties for sale and rent in ".$city,
                        ];

              }


        }else{

            
            return ['title'=>"properties for sale and rent in ".$city,
            'desc'=>"properties for sale and rent in ".$city,
           ];


        }



    }


?>