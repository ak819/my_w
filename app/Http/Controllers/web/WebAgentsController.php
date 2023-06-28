<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class WebAgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $agents = $this->getAgents();
        echo '<pre>';print_r($agents);
        //return view('some-view')->with('users', $users);
    }

     public function getAgents()
    {
        $agents = DB::table('propety_agents')->select('ID','Name','Email','Phone','Photo')->orderBy('ID', 'DESC')->get();
       
        return  $agents;
    }
 



 }   

  