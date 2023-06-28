<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyImages;

class PropertyImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        $Images=PropertyImages::select(['pi.*','p.Guid as PropertyID','p.PropertyRefNo'])
                    ->from('property_images as pi')
                    ->where('p.Guid',$id)
                    ->where('pi.IsThumbnail',0)
                    ->join('properties as p','p.ID','=','pi.PropertyID')
                    ->get();

       
        if(!$Images->isEmpty())
        {
            $Images->PropertyID=$Images[0]->PropertyID;
            $Images->PropertyRefNo=$Images[0]->PropertyRefNo;
            return view('properties.edit-property-images',compact('Images'));
        }            
       
        return view('properties.edit-property-images',compact('Images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Guid=$request->input('Guid');
        $ImageNameEn=$request->input('ImageNameEn');
        $ImageNameAr=$request->input('ImageNameAr');
        for($i=0;$i<count($Guid);$i++)
        {
            $Property=PropertyImages::find($Guid[$i]);
            $Property->ImageNameEn=$ImageNameEn[$i];
            $Property->ImageNameAr=$ImageNameAr[$i];
            $Property->save();
    
        }
        return redirect()->route('propertyImages.edit', $id)->withInput()->with('success', 'Property has been editted successfully.');
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
