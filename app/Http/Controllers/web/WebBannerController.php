<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class WebBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

       $banner = $this->getbanner();
        
        echo '<pre>';print_r($banner);

        //return view('some-view')->with('users', $users);
    }

     public function getbanner()
    {
        $banner = DB::table('banners')->select('ID','Image')->orderBy('ID', 'DESC')->get();
        return  $banner;
    }
 



 }   

  