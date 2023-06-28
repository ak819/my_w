<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Seourl;


class SeourlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $list= Seourl::select('se.*','pt.TypeName')
                       ->from('seourls as se')
                       ->join('property_unit_types as pt', 'pt.ID', '=', 'se.UnitTypeID')
                       ->get();
        return view('seourls.seourl-list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $property_type=getPropertyTypes();
        return view('seourls.add-seourl',compact('property_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'property_type'=>'required',
            'add_type'=>'required',
            'title' => 'required',
            'title_arabic'=>'required',
            'link' => 'required',
        ],[
        
        ]);
        $Guid = (string) Str::uuid();
        $input = $request->all();
        $data = [
            'Guid' => (string) Str::uuid(),
            'UnitTypeID' => $input['property_type'],
            'AdType' => $input['add_type'],
            'Title' => $input['title'],
            'TitleAr' => $input['title_arabic'],
            'Link' => $input['link'],
            'CreatedBy' =>Auth::user()->id,
            'IsEnable' =>1
        ];

         Seourl::create($data);

        return redirect()->route('seourl.index')->withInput()
            ->with('success', 'The seo url has been added successfully');
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
        $seourl = Seourl::where('Guid', $id)->first();
        $property_type=getPropertyTypes();
        return view('seourls.edit-seourl', compact('seourl','property_type'));
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

        $seourl = Seourl::where('Guid', $id)->first();
        $validatedData = $request->validate([
            'property_type'=>'required',
            'add_type'=>'required',
            'title' => 'required',
            'title_arabic'=>'required',
            'link' => 'required',
        ],[
        
        ]);
        $Guid = (string) Str::uuid();
        $input = $request->all();
        $data = [
            'Guid' => (string) Str::uuid(),
            'UnitTypeID' => $input['property_type'],
            'AdType' => $input['add_type'],
            'Title' => $input['title'],
            'TitleAr' => $input['title_arabic'],
            'Link' => $input['link'],
            'ModifiedBy' =>Auth::user()->id,
            'IsEnable' => empty($input['IsEnable']) ? 0 : 1
        ];

        seourl::whereId($seourl->ID)->update($data);

        return redirect()->route('seourl.index')->withInput()
            ->with('success', 'The seo url has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = seourl::find($id);        
        $delete = $delete->delete();
        if($delete)
        { 
            return redirect()->route('seourl.index')
            ->with('success','The seo url has been deleted successfully.');

        }else{
            return redirect()->route('seourl.index')
            ->with('error','An error occured no data found.');

        }
    }
}
