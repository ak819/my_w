<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use Image;
//use Illuminate\Support\Facades\DB;



class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
        $banners = Banner::all()->sortByDesc("ID");
        return view('banners.list-banners',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
      
        return view('banners.add-banner');
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
          'Image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
         ]);
       
         $input = $request->all();     

         if ($image = $request->file('Image')) 
         {
            
            $filename=(string) Str::uuid(). '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move('uploads/banner', $filename);
            $input['image'] = $filename;
         }
     
        $data= [
            'Guid'=> (string) Str::uuid(),
            'Image' =>  $input['image'],
            'Alt'=>$input['Alt'],
            'CreatedBy' => '1',
            'ModifiedBy' => '1',
            'IsEnable' => 1
           ];
       Banner::create($data);
    
        return redirect()->route('banner.create')
                        ->with('success','The banner has been added successfully .');
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
    public function edit(Banner $banner)
    {
       // return view('banners.edit-banner');
         return view('banners.edit-banner',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
       
        $Guid=$request->input('Guid');
         if(!$request->input('prev_image') AND empty($request->file('Image')))
		  {
             
         $request->validate([

            'Image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

           ]);

		 }

        $input = $request->all();
        if ($image = $request->file('Image')) {

            $prev_image= $request->input('prev_image');
            $image_path = "uploads/banner/$prev_image";
            $destinationPath = 'uploads/banner';
            if(file_exists($image_path)){
                unlink($image_path);
            }
            $profileImage =(string) Str::uuid(). '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";

        }else{
           $input['image'] = $request->input('prev_image');
        }
        $data= [
           
            'Image' =>  $input['image'],
            'Alt'=>$input['Alt'],
            'ModifiedBy' => '1',
            'IsEnable' => empty($input['IsEnable']) ? 0 : 1
            
           ];

        $banner->update($data);
         return redirect()->route('banner.edit', $Guid)->withInput()->with('success', 'The banner has been updated successfully');

        // return redirect()->route('banner.index')

        //                 ->with('success','The banner has been updated successfully');
                       
        
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::where('Guid', $id)->first();
        $oldImage = "uploads/banner/$banner->Image";
        if($banner )
        {
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            Banner::where('Guid', $id)->delete();
            return redirect()->route('banner.index')->withInput()->with('success', 'The banner has been deleted successfully');

        }else{

            return redirect()->route('banner.index')->withInput()->with('error', 'An error while deleting banner'); 
        }
        
    }
}