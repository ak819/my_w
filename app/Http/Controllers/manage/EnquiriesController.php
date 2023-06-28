<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyEnquiries;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class EnquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AssignedAgentTypes=getLoggedInUserAgentTypes();
        if(Auth::user()->roleid!==1)
        {
            $enquiries  = PropertyEnquiries::join('properties as p', 'pe.PropertyID', '=', 'p.ID')
            ->from('property_enquiries as pe')
            ->whereIn('p.AgentID',$AssignedAgentTypes)
            ->orderBy('pe.CreatedDate','DESC')
            ->get(['pe.*','p.PropertyRefNo']);
        }else{
            $enquiries  = PropertyEnquiries::join('properties as p', 'pe.PropertyID', '=', 'p.ID')
        
                                 ->from('property_enquiries as pe')
                                 ->orderBy('pe.CreatedDate','DESC')
                                 ->get(['pe.*','p.PropertyRefNo']);
        }
      
        return view('enquirie.list-enquiries',compact('enquiries'));
       
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
        return view('agents/edit-agent');
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
        $Enquiry=PropertyEnquiries::find($id);
       // DB::enableQueryLog(); 
        $Enquiry->Isfollowed=$request->input('Isfollowed');
        $Enquiry->save();
        //$query =DB::getQueryLog();
       //dd($query);
        return redirect()->route('enquiries.index')->withInput()->with('success', 'Enquiry status has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $PropertyEnquiries = PropertyEnquiries::where('Guid', $id)->first();
       // $oldImage = "uploads/banner/$banner->Image";
        if($PropertyEnquiries )
        {
            
            PropertyEnquiries::where('Guid', $id)->delete();
            return redirect()->route('enquiries.index')->withInput()->with('success', 'The  Enquiries has been deleted successfully');

        }else{

            return redirect()->route('enquiries.index')->withInput()->with('error', 'An error while deleting banner'); 
        }
    }
    public function updatePropertyEnquiryNote(Request $request)
    {
        $request->validate([
            'note' => 'required',
        ]);
        PropertyEnquiries::where('Guid',$request->input('id'))->update([
            'Note' => $request->input('note')
        ]);
        return redirect()->route('enquiries.index')->withInput()->with('success', 'The Enquiries note has been updated successfully');
    }
     
    public function contactenquiries()
    {
        $enquiries=DB::table('contact_enquiries')->get();
        return view('enquirie.list-contact',compact('enquiries'));
    }
   
    public function updateContactEqNote(Request $request)
    {
            $request->validate([
                'note' => 'required',
            ]);
            DB::table('contact_enquiries')->where('Guid',$request->input('id'))->update([
                'Note' => $request->input('note')
            ]);
            return redirect()->route('contact-enquiries')->withInput()->with('success', 'The Enquiries note has been updated successfully');
    }
    public function updateContactEqFollowup(Request $request, $id)
    {
        DB::table('contact_enquiries')->where('Guid',$id)->update([
            'Isfollowed' => $request->input('Isfollowed')
        ]);
        return redirect()->route('contact-enquiries')->withInput()->with('success', 'Enquiry status has been updated successfully.');
    }
    public function destroyContactEq($id)
    {
        $Enquiries =DB::table('contact_enquiries')->where('Guid', $id)->first();
       // $oldImage = "uploads/banner/$banner->Image";
        if($Enquiries)
        {
            
            DB::table('contact_enquiries')->where('Guid', $id)->delete();
            return redirect()->route('contact-enquiries')->withInput()->with('success', 'The  Enquiries has been deleted successfully');

        }else{

            return redirect()->route('contact-enquiries')->withInput()->with('error', 'An error while deleting banner'); 
        }
    }


    public function service_enquiries()
    {
        $enquiries=DB::table('service_enquiries')->get();
        return view('enquirie.list-service',compact('enquiries'));
    }

    public function updateServiceEqNote(Request $request)
    {
            $request->validate([
                'note' => 'required',
            ]);
            DB::table('service_enquiries')->where('Guid',$request->input('id'))->update([
                'Note' => $request->input('note')
            ]);
            return redirect()->route('service-enquiries')->withInput()->with('success', 'The Enquiries note has been updated successfully');
    }
    public function uupdateServiceEqFollowup(Request $request, $id)
    {
        DB::table('service_enquiries')->where('Guid',$id)->update([
            'Isfollowed' => $request->input('Isfollowed')
        ]);
        return redirect()->route('service-enquiries')->withInput()->with('success', 'Enquiry status has been updated successfully.');
    }
    public function destroyServiceEq($id)
    {
        $Enquiries =DB::table('service_enquiries')->where('Guid', $id)->first();
       // $oldImage = "uploads/banner/$banner->Image";
        if($Enquiries)
        {
            
            DB::table('service_enquiries')->where('Guid', $id)->delete();
            return redirect()->route('service-enquiries')->withInput()->with('success', 'The  Enquiries has been deleted successfully');

        }else{

            return redirect()->route('service-enquiries')->withInput()->with('error', 'An error while deleting banner'); 
        }
    }

    
    public function evaluation_enquiries()
    {
        $enquiries=DB::table('evaluation_enquiries')->get();
        return view('enquirie.list-evaluation',compact('enquiries'));
    }

    public function updateEvaluationFollowup(Request $request, $id)
    {
        DB::table('evaluation_enquiries')->where('Guid',$id)->update([
            'Isfollowed' => $request->input('Isfollowed')
        ]);
        return redirect()->route('evaluation-enquiries')->withInput()->with('success', 'Enquiry status has been updated successfully.');
    }

    public function updateEvaluationEqNote(Request $request)
    {
            $request->validate([
                'note' => 'required',
            ]);
            DB::table('evaluation_enquiries')->where('Guid',$request->input('id'))->update([
                'Note' => $request->input('note')
            ]);
            return redirect()->route('evaluation-enquiries')->withInput()->with('success', 'The Enquiries note has been updated successfully');
    }

    public function destroyEvaluationEq($id)
    {
        $Enquiries =DB::table('evaluation_enquiries')->where('Guid', $id)->first();
       // $oldImage = "uploads/banner/$banner->Image";
        if($Enquiries)
        {
            
            DB::table('evaluation_enquiries')->where('Guid', $id)->delete();
            return redirect()->route('evaluation-enquiries')->withInput()->with('success', 'The  Enquiries has been deleted successfully');

        }else{

            return redirect()->route('evaluation-enquiries')->withInput()->with('error', 'An error while deleting banner'); 
        }
    }

}
