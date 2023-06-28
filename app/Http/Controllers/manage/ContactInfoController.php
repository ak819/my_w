<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactInfo;
use Illuminate\Support\Str;

class ContactInfoController extends Controller
{
    //
    //    public function edit()
    // {
    //     $testimonials = ContactInfo::all()->sortByDesc("ID");
    //     print_r($testimonials);
    // }

    public function edit(ContactInfo $contactinfo)
    {
        return view('contactinfo.edit-contactinfo',compact('contactinfo'));
    }


     public function update(Request $request,ContactInfo $contactinfo)
    {

        $Guid = $request->input('Guid');
           
        $testimonialdData = $request->validate([

           'Email' => 'required|email',
           'Phone' => 'required',
           'Address' => 'required',
           'AddressAr' => 'required'
         ],[
            
            'AddressAr.required' => 'The message arabic field is required'
        ]);
       
        $input = $request->all();
       
       
            $data= [
            'Email' => $request->input('Email'),
            'Phone' => $request->input('Phone'),
           // 'Rating' =>   $request->input('Rating'),
            'Address' =>   $request->input('Address'),
            'AddressAr' =>   $request->input('AddressAr'),            
           ];

        $contactinfo->update($data);
        return redirect()->route('contactinfo.edit', $Guid)->withInput()->with('success', 'The Contact Info has been updated successfully');

      
    }//



}

