<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Communities;

class CommunitiesController extends Controller
{
    /*----- 
    Author:Akshay 
    Date: 1-01-2022 
    Function:for community list by cityid ajax 
    -----*/
    public function getLocationList(Request $request)
    {   
        $CityID=$request->cityid;
        $Lang=$request->lang;
        if($Lang=="en")
        {
            if($CityID)
            { 
                $data['locations']=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                                 ->where('communities.CityID',$CityID)
                                 ->where('communities.IsEnable',1)
                                 ->groupBy('communities.ID')
                                 ->orderBy('communities.CommunityName','asc')
                                 ->get(['communities.ID as id','communities.CityID','communities.CommunityName AS CommunityName','communities.CommunityName AS CommunityNameEng']);
            }else{
                $data['locations']=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                ->where('communities.IsEnable',1)
                ->groupBy('communities.ID')
                ->orderBy('communities.CommunityName','asc')
                ->get(['communities.ID as id','communities.CityID','communities.CommunityName AS CommunityName','communities.CommunityName AS CommunityNameEng']);
            }
      
        }else{
            if($CityID)
            { 
            $data['locations']=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
            ->where('communities.CityID',$CityID)
            ->where('communities.IsEnable',1)
            ->groupBy('communities.ID')
            ->orderBy('communities.CommunityName','asc')
            ->get(['communities.ID as id','communities.CityID','communities.CommunityNameAr AS CommunityName','communities.CommunityName AS CommunityNameEng']);
            }else{
                $data['locations']=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
            ->where('communities.IsEnable',1)
            ->groupBy('communities.ID')
            ->orderBy('communities.CommunityName','asc')
            ->get(['communities.ID as id','communities.CityID','communities.CommunityNameAr AS CommunityName','communities.CommunityName AS CommunityNameEng']); 

                 
            }
        }
            return response()->json($data);
    }

    public function getMultipleLocationList(Request $request)
    {   
        $CityID=$request->cityid;
       
            if($CityID)
            { 
                $data['locations']=Communities::join('properties', 'communities.ID', '=', 'properties.CommunityID')
                                 ->whereIn('communities.CityID',$CityID)
                                 ->where('communities.IsEnable',1)
                                 ->groupBy('communities.ID')
                                 ->orderBy('communities.CommunityName','asc')
                                 ->get(['communities.ID as id','communities.CityID','communities.CommunityName AS CommunityName']);
            }else{
                $data['locations']=[];
            }   
            return response()->json($data);
    }
    
}
