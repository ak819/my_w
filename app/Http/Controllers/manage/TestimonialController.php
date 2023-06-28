<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonials;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonials::all()->sortByDesc("ID");
        return view('testimonials.list-testimonials',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testimonials.add-testimonial');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $testimonialdData = $request->validate([

        //    'CustomerName' => 'required',
        //    'CustomerNameAr' => 'required',
        //    //'Rating' => 'required',
        //    //'Designation' => 'required',
        //    //'DesignationAr' => 'required',
        //    'Message' => 'required',
        //    'MessageAr' => 'required'
        //  ],[
        //     'CustomerNameAr.required' => 'The customerName arabic field is required',
        //     //'DesignationAr.required' => 'The designationAr arabic field is required',
        //     'MessageAr.required' => 'The message arabic field is required'
        // ]);

        
        
         $input = $request->all();     

        //  if ($image = $request->file('Photo')) 
        //  {
            
        //     $filename =  (string) Str::uuid(). '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move('uploads/testimonial', $filename);
        //     $input['image'] = $filename;
        //  }
       
        $data= [
            'Guid'=> (string) Str::uuid(),
            'CustomerName' =>  $request->input('CustomerName'),
            'CustomerNameAr' => $request->input('CustomerNameAr'),
            //'Rating' =>    $testimonialdData['Rating'],
            'Message' =>  $request->input('Message'),
            'MessageAr' => $request->input('MessageAr'),
            //'Designation' =>   $testimonialdData['Designation'],
            //'DesignationAr' =>   $testimonialdData['DesignationAr'],
            //'Photo' =>  $input['image'],
            'CreatedBy' => '1',
            'ModifiedBy' => '1',
            'IsEnable' => 1
           ];
           //echo "<pre>";print_r($data);die;
       Testimonials::create($data);
    
        return redirect()->route('testimonial.create')
                        ->with('success','The testimonial has been added successfully ');
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
    public function edit(Testimonials $testimonial)
    {
        return view('testimonials.edit-testimonial',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Testimonials $testimonial)
    {

        $Guid = $request->input('Guid');
           
        // $testimonialdData = $request->validate([

        //    'CustomerName' => 'required',
        //    'CustomerNameAr' => 'required',
        //    //'Rating' => 'required',
        //    //'Designation' => 'required',
        //    //'DesignationAr' => 'required',
        //    'Message' => 'required',
        //    'MessageAr' => 'required'
        //  ],[
        //     'CustomerNameAr.required' => 'The customer name arabic field is required',
        //     //'DesignationAr.required' => 'The designation arabic field is required',
        //     'MessageAr.required' => 'The message arabic field is required'
        // ]);
       
        $input = $request->all();
        // if ($image = $request->file('Photo')) {

        //     $prev_image= $request->input('prev_image');
        //     $image_path = "uploads/testimonial/$prev_image";
        //     $destinationPath = 'uploads/testimonial';
        //     if(file_exists($image_path)){
        //         unlink($image_path);
        //     }
        //     $profileImage=(string) Str::uuid(). '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $input['image'] = "$profileImage";

        // }else{
        //    $input['image'] = $request->input('prev_image');
        // }
       
            $data= [
            'CustomerName' => $request->input('CustomerName'),
            'CustomerNameAr' => $request->input('CustomerNameAr'),
            //'Rating' =>   $request->input('Rating'),
            'Message' =>   $request->input('Message'),
            'MessageAr' =>   $request->input('MessageAr'),
            //'Designation' =>   $request->input('Designation'),
            //'DesignationAr' =>   $request->input('DesignationAr'),
            //'Photo' =>  $input['image'],
            'ModifiedBy' => '1',
            'IsEnable' => empty($input['IsEnable']) ? 0 : 1
           ];

        $testimonial->update($data);
        return redirect()->route('testimonial.edit', $Guid)->withInput()->with('success', 'The testimonial has been updated successfully');

      
    }//

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonials::where('Guid', $id)->first();
    
        if($testimonial )
        {
          
            Testimonials::where('Guid', $id)->delete();
            return redirect()->route('testimonial.index')->withInput()->with('success', 'The testimonial has been deleted successfully');

        }else{

            return redirect()->route('testimonial.index')->withInput()->with('error', 'An error while deleting testimonial'); 
        }
        
    }
}
