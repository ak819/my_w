<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Communities;
use Illuminate\Support\Str;

class CommunitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Communities =Communities::select("communities.*","cities.CityName",DB::raw("(SELECT COUNT(properties.ID) FROM properties
        WHERE properties.CommunityID  = communities.ID 
        AND properties.AdType= 1
        GROUP BY properties.CommunityID) as properties_rent_count"),
        DB::raw("(SELECT COUNT(properties.ID) FROM properties
        WHERE properties.CommunityID  = communities.ID 
        AND properties.AdType= 2
        GROUP BY properties.CommunityID) as properties_sale_count"),
        DB::raw("(SELECT MIN(properties.Price) FROM properties
        WHERE properties.CommunityID  = communities.ID 
        AND properties.AdType= 2 ) as min_sale_price")
        )
        ->join('cities', 'cities.ID', '=', 'communities.CityID')
        ->groupBy('communities.ID')
        ->get(['communities.*','cities.CityName']);
       
        return view('community.list-communities',compact('Communities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Communities $community)
    {
       
       return view('community.edit-community',compact('community'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Communities $community)
    {
         $Guid = $request->input('Guid');
        $cityData = $request->validate([

           //'CommunityName' => 'required',
           'CommunityNameAr' => 'required',
          
         ]);
         if($request->file('Image'))
		  {
             
         $request->validate([

            'Image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

           ]);

		 }
         $input = $request->all();
        if ($image = $request->file('Image')) {

            $prev_image= $request->input('prev_image');
            $image_path = "uploads/communities/$prev_image";
            $destinationPath = 'uploads/communities';
            if($prev_image && file_exists($image_path)){
                unlink($image_path);
            }
            $Image =(string) Str::uuid(). '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $Image);
            $input['image'] = "$Image";

        }else{
           $input['image'] = $request->input('prev_image');
        }
        
         $data= [
            //'CommunityName' => $request->input('CommunityName'),
            'Image'=>$input['image'],
            'Alt'=>$input['Alt'],
            'CommunityNameAr' =>$request->input('CommunityNameAr'),
            'ModifiedBy' => '1',
            'IsEnable' =>empty($input['IsEnable']) ? 0 : 1,
            'IsFeatured' =>empty($input['IsFeatured']) ? 0 : 1
           ];
           
        $community->update($data);
        return redirect()->route('communities.edit', $Guid)->withInput()->with('success', 'The location has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
