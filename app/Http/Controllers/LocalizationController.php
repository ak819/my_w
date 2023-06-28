<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use App\Models\Currency;
use App\Models\Services;
use App\Models\Blog;
use Illuminate\Support\Facades\Crypt;

class LocalizationController extends Controller
{   
   

    public function langChange($lang)
    {
        try {
            App::setLocale($lang);
            session()->put('locale', $lang);
            $url= URL::previous();
            $urlarray=explode('/',$url);
            $urlarray[3]=$lang;
            switch ($urlarray) {
                case(in_array('services',$urlarray)):
                    $urlarray[5]=findSlug('services',$lang,$urlarray[5]);
                    break;
                case(in_array('blogs',$urlarray) && in_array('detail',$urlarray)):
                    $urlarray[6]=findSlug('blogs',$lang,$urlarray[6]);
                    break;
                case(!in_array('property',$urlarray) && in_array('sale',$urlarray)  && count($urlarray)==8):
                       
                         $urlarray[4]="للبيع";
                         $urldata=findPropertySlug('properties',$lang,$urlarray[7]);
                         $urlarray[5]=$urldata[0]->Plural;
                         $urlarray[6]=$urldata[0]->Slug;
                        break;
               case(!in_array('property',$urlarray) && in_array('rent',$urlarray) && count($urlarray)==8 ):
                 $urlarray[4]="للايجار";
                 $urldata=findPropertySlug('properties',$lang,$urlarray[7]);
                 $urlarray[5]=$urldata[0]->Plural;
                 $urlarray[6]=$urldata[0]->Slug;
                 break;
                case(in_array('%D9%84%D9%84%D8%A8%D9%8A%D8%B9',$urlarray)):
                    $urlarray[4]="sale";
                    $urldata=findPropertySlug('properties',$lang,$urlarray[7]);
                    $urlarray[5]=$urldata[0]->Plural;
                    $urlarray[6]=$urldata[0]->Slug;
                 break;
                case(in_array('%D9%84%D9%84%D8%A7%D9%8A%D8%AC%D8%A7%D8%B1',$urlarray)):
                    $urlarray[4]="rent";
                    $urldata=findPropertySlug('properties',$lang,$urlarray[7]);
                    $urlarray[5]=$urldata[0]->Plural;
                    $urlarray[6]=$urldata[0]->Slug;
                  break;
                default:
                    # code...
                    break;
            }
            
            $url=implode('/',$urlarray);
            return redirect($url);
        } catch (\Throwable $th) {

            echo  $th->getMessage();
            //abort(404);
        }
        
    }
    public function changeCurrency($c)
    {   
        $Currency=Currency::where('Name',$c)->get()->first();
        if($Currency)
        {  
            $data=[$Currency->Name,$Currency->Value,$Currency->flag];
            session()->put('currency', $data);
        }else{
            $Currency=Currency::get()->first();
            $currency=[$Currency->Name,$Currency->Value,$Currency->flag];
        }
        $value = session('currency');
        return redirect()->back();
    }
   

}
