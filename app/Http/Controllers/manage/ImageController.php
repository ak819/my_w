<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroBanner;
use App\Models\AboutUsImages;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
   /**
     * Display a listing of the hero Banner.
     *
     * @return \Illuminate\Http\Response
     */
    public function listHeroBanners()
    {
       
        
        $banners = HeroBanner::where('IsEnable',1)->orderBy("ID",'ASC')->get();
        return view('images.list-hero-banners',compact('banners'));
    }
      
    public function editHeroBanner($id)
    {  
        $banner=HeroBanner::find($id);
        return view('images.edit-hero-banner',compact('banner'));
 
    }
    /**
     * Update the specified resource in Hero banner.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateHeroBanner(Request $request,$id)
    {

        $banner=HeroBanner::find($id);
         if(!$request->input('prev_image') AND empty($request->file('Image')))
		  {
             
         $request->validate([

            'Image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

           ]);

		 }
        $input = $request->all();
        if ($image = $request->file('Image')) {

            $prev_image= $request->input('prev_image');
            if($prev_image)
            {
                $image_path = "uploads/herobanner/$prev_image";
              
                if(file_exists($image_path)){
                    unlink($image_path);
                }
            }
            $destinationPath = 'uploads/herobanner';
            $profileImage =(string) Str::uuid(). '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";

        }else{
           $input['image'] = $request->input('prev_image');
        }
        
           $banner->Image=$input['image'];
           $banner->Alt=$input['Alt'];
           $banner->ModifiedBy=Auth::user()->id;
           $banner->save();

         return redirect()->route('hero-banner.edit', $id)->withInput()->with('success', 'The banner has been updated successfully');

                       
        
    }

       /**
     * Display a listing of the aboutus images.
     *
     * @return \Illuminate\Http\Response
     */
    public function listAboutImages()
    {
       
        
        $banners = AboutUsImages::all()->sortBy("ID");
        return view('images.list-about-images',compact('banners'));
    }

    public function editAboutImage($id)
    { 
        $banner=AboutUsImages::find($id);
        return view('images.edit-about-image',compact('banner'));
 
    }

    /**
     * Update the specified resource in About Images.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAboutImage(Request $request,$id)
    {

        $about_image=AboutUsImages::find($id);
         if(!$request->input('prev_image') AND empty($request->file('Image')))
		  {
             
         $request->validate([

            'Image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

           ]);

		 }
        $input = $request->all();
        if ($image = $request->file('Image')) {

            $prev_image= $request->input('prev_image');
            if($prev_image)
            {
                $image_path = "uploads/aboutus/$prev_image";
              
                if(file_exists($image_path)){
                    unlink($image_path);
                }
            }
            $destinationPath = 'uploads/aboutus';
            $profileImage =(string) Str::uuid(). '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";

        }else{

           $input['image'] = $request->input('prev_image');
        }
        
           $about_image->Image=$input['image'];
           $about_image->Alt=$input['Alt'];
           $about_image->ModifiedBy=Auth::user()->id;
           $about_image->save();

         return redirect()->route('about-image.edit', $id)->withInput()->with('success', 'The image has been updated successfully');

                       
        
    }

}
