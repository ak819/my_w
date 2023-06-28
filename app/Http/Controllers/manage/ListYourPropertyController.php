<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyList;
use Illuminate\Support\Facades\DB;

class ListYourPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $items = PropertyList::all()->sortByDesc("CreatedDate");
        return view('listpropertyinquiry.list-properties', compact('items'));
    }

    public function updatePropertyDetail($isfollowup,$id)
    {
       
        PropertyList::where('Guid', $id)->update([
            'IFollowup' => $isfollowup
        ]);
        return redirect()->route('listyourproperty.index')->withInput()->with('success', 'The list property followup taken successfully');
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propertylist = PropertyList::where('Guid', $id)->first();
       // $oldImage = "uploads/banner/$banner->Image";
        if($propertylist )
        {
            
            PropertyList::where('Guid', $id)->delete();
            return redirect()->route('listyourproperty.index')->withInput()->with('success', 'The  property request has been deleted successfully');

        }else{

            return redirect()->route('listyourproperty.index')->withInput()->with('error', 'An error while deleting banner'); 
        }
    }
    public function updatePropertyListNote(Request $request)
    {
        $request->validate([
            'note' => 'required',
        ]);
        PropertyList::where('Guid',$request->input('id'))->update([
            'Note' => $request->input('note')
        ]);
        return redirect()->route('listyourproperty.index')->withInput()->with('success', 'The Property request has been updated successfully');
    }
   
  

}
