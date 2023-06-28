<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class WebTestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        $testimonials = $this->getTestimonials();
        echo '<pre>';print_r($testimonials);

        
    }

     public function getTestimonials()
    {
        $testimonials = DB::table('testimonials')->select('ID','CustomerName','Designation','Message','Photo')->orderBy('ID', 'DESC')->get();

        return  $testimonials;
    }
 



 }   

  