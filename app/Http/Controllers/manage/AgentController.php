<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agents;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Property;
use App\Models\PropertyUnitTypes;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agents::all()->sortByDesc("ID");
        return view('agents.list-agents', compact('agents'));
        //return view('agents.list-agents');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agents.add-agent');
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
        $Data = Agents::find($id);
        // print_r($Data);exit;
        $Data->PropertyUnitTypes = PropertyUnitTypes::join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
            ->where('property_unit_types.IsEnable', 1)
            ->groupBy('property_unit_types.ID')
            ->get(['property_unit_types.*']);
        return view('agents/edit-agent', compact('Data'));
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
        if (!$request->input('prev_image') and empty($request->file('Photo'))) {
            $request->validate([

                'Photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

            ]);
        }
        $request->validate([
            'DisplayName' => 'required',
            'DisplayNameAr'  => 'required',
            'DisplayEmail' => 'required',
            'DisplayPhone'  => 'required',
        ], [
            'DisplayName.required' => 'The dispaly agent name arabic field is required',
            'DisplayNameAr.required' => 'The dispaly agent name arabic field is required',
            'DisplayEmail.required' => 'The dispaly agent email field is required',
            'DisplayPhone.required' => 'The dispaly agent phone field is required',
        ]);
        $imageName = "";
        $prev_img = $request->input('prev_image');
        if ($image = $request->file('Photo')) {
            if ($prev_img) {
                $oldImage = "uploads/agent/$prev_img";
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $imageDestinationPath = 'uploads/agent';
            $imageName = (string) Str::uuid() . '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $imageName);
        } else {

            $imageName = $prev_img;
        }
        $Data = Agents::find($id);
        $Data->DisplayName = $request->input('DisplayName');
        $Data->DisplayNameAr = $request->input('DisplayNameAr');
        $Data->DisplayEmail = $request->input('DisplayEmail');
        $Data->DisplayPhone = $request->input('DisplayPhone');
        $Data->DisplayPhoto = $imageName;
        //$Data->PropertyType = $request->input('property');
        //print_r($Data->property);exit;
        $Data->save();
        return redirect()->route('agent.edit', $id)->withInput()->with('success', 'Agent has been updated successfully.');;
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
