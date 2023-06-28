<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;
use Illuminate\Support\Str;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = Cities::all();
       
        return view('city.list-cities',compact('cities'));
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
    public function edit(Cities $city)
    {
      
       return view('city.edit-city',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cities $city)
    {

         $Guid = $request->input('Guid');
        $cityData = $request->validate([

           //'CityName' => 'required',
           'CityNameAr' => 'required',
          
         ]);
         $input = $request->all();
         $data= [
            //'CityName' => $request->input('CityName'),
            'CityNameAr' => $request->input('CityNameAr'),
            'ModifiedBy' => '1',
            'IsEnable' => empty($input['IsEnable']) ? 0 : 1
           ];
           //print_r($data);die;

        $city->update($data);
        return redirect()->route('cities.edit', $Guid)->withInput()->with('success', 'The city has been updated successfully');
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
