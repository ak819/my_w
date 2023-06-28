<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PageMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        
        $media = Media::all()->sortByDesc("ID");
        return view('media.list-medias',compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('media.add-media');
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
            $image->move('uploads/media', $filename);
            $input['image'] = $filename;
         }
       
        $data= [
            'Guid'=> (string) Str::uuid(),
            'Image' =>  $input['image'],
            'CreatedBy' => Auth::user()->id,
            'IsEnable' => 1
           ];
           Media::create($data);
    
        return redirect()->route('media.index')
                        ->with('success','The media has been added successfully .');
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
    public function edit(Media $banner)
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
    public function update(Request $request, Media $banner)
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
        $banner = Media::where('Guid', $id)->first();
        $oldImage = "uploads/media/$banner->Image";
        if($banner )
        {
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            Media::where('Guid', $id)->delete();
            return redirect()->route('media.index')->withInput()->with('success', 'The media has been deleted successfully');

        }else{

            return redirect()->route('media.index')->withInput()->with('error', 'An error while deleting media'); 
        }
        
    }
}
