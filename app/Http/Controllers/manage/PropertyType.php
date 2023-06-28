<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyUnitTypes;

class PropertyType extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = PropertyUnitTypes::all();
       
        return view('propertytype.list-propertytype',compact('list'));
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
        $Data=PropertyUnitTypes::find($id);
        return view('propertytype.edit-propertytype',compact('Data'));
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
        $validatedData = $request->validate([
            'TypeNameAr' => 'required',
        ],[
            'TypeNameAr.required' => 'The property type name arabic field is required',
        ]);
        $Type=PropertyUnitTypes::find($id);
        $Type->TypeNameAr=$request->input('TypeNameAr');
        $Type->IsEnable=($request->input('IsEnable')) ? 1 : 0;
        $Type->Slug=generateSlug('property_unit_types','TypeName',$Type->TypeName);
        $Type->SlugAr=generateSlugAr('property_unit_types','TypeNameAr',$request->input('TypeNameAr'));
        $Type->save();
        return redirect()->route('propertytype.edit', $id)->withInput()->with('success', 'Property Type has been editted successfully.');
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
