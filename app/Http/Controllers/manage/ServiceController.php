<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $service_table;

    public function __construct(){
      $this->service_table='services';  
    }
    public function index()
    {
        $items = Services::all()->sortByDesc("ID");
        return view('services.list-services', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.add-service');
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
            'SubHeading' => 'required',
            'SubHeadingAr'=>'required',
            'Title' => 'required',
            'TitleAr'=>'required',
            'Image' => 'required',
            'Description'  => 'required',
            'DescriptionAr'=>'required',
            'Image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'SubHeadingAr.required'=>'The Sub heading arabic field is required',
            'TitleAr.required' => 'The title arabic field is required',
            'DescriptionAr.required' => 'The description arabic field is required'
        ]);
        $Guid = (string) Str::uuid();
        $input = $request->all();
        if ($image = $request->file('Image')) {
            $extainsion = $image->getClientOriginalExtension();
            $filename = $Guid . '-' . date('YmdHis') . "." . $extainsion;
            
            $image->move('uploads/services', $filename);
            $input['image'] = $filename;
        }
        $service = new Services();
        $data = [
            'Guid' => (string) Str::uuid(),
            'SubHeading' => $input['SubHeading'],
            'SubHeadingAr' => $input['SubHeadingAr'],
            'Slug'=>generateSlug($this->service_table,'SubHeading',$input['SubHeading']),
            'SlugAr'=>generateSlugAr($this->service_table,'SubHeadingAr',$input['SubHeadingAr']),
            'Title' => $input['Title'],
            'TitleAr' => $input['TitleAr'],
            'Description' => $input['Description'],
            'DescriptionAr' => $input['DescriptionAr'],
            'MetaTitle' => $input['MetaTitle'],
            'MetaTitleAr' => $input['MetaTitleAr'],
            'MetaDescription' => $input['MetaDescription'],
            'MetaDescriptionAr' => $input['MetaDescriptionAr'],
            'Image' =>  $input['image'],
            'CreatedBy' => '1',
            'ModifiedBy' => '1',
            'IsEnable' => 1,
            'Alt'=> $input['Alt']
        ];

       
        Services::create($data);

        return redirect()->route('service.create')->withInput()
            ->with('success', 'The service has been added successfully ');
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
        $service = Services::where('Guid', $id)->first();
        return view('services.edit-service', compact('service'));
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

        
        
        $service = Services::where('Guid', $id)->first();
        $request->validate([
            'SubHeading' => 'required',
            'SubHeadingAr'=>'required',
            'Title' => 'required',
            'Description'  => 'required',
            'TitleAr' => 'required',
            'DescriptionAr'  => 'required',
        ],[ 
            'SubHeadingAr.required'=>'The Sub heading arabic field is required',
            'TitleAr.required' => 'The title arabic field is required',
            'DescriptionAr.required' => 'The description arabic field is required'
        ]);
        $input = $request->all();
        if ($image = $request->file('Image')) {
            $oldImage ="uploads/services/$service->Image";
            if (File::exists($oldImage)) {
                unlink($oldImage);
            }
            $imageDestinationPath ='uploads/services';
            $postImage = (string) Str::uuid(). '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        } else {
            unset($input['image']);
        }

        $data = [
            'SubHeading' => $input['SubHeading'],
            'Slug'=>generateSlug($this->service_table,'SubHeading',$input['SubHeading']),
            'SlugAr'=>generateSlugAr($this->service_table,'SubHeadingAr',$input['SubHeadingAr']),
            'SubHeadingAr' => $input['SubHeadingAr'],
            'Title' => $input['Title'],
            'TitleAr' => $input['TitleAr'],
            'Description' => $input['Description'],
            'DescriptionAr' => $input['DescriptionAr'],
            'MetaTitle' => $input['MetaTitle'],
            'MetaTitleAr' => $input['MetaTitleAr'],
            'MetaDescription' => $input['MetaDescription'],
            'MetaDescriptionAr' => $input['MetaDescriptionAr'],
            'CreatedBy' => '1',
            'ModifiedBy' => '1',
            'IsEnable' => empty($input['IsEnable']) ? 0 : 1,
            'Alt'=> $input['Alt']
        ];
        if (!empty($input['image'])) {
            $data['Image'] = $input['image'];
        }
        Services::whereId($service->ID)->update($data);
        return redirect()->route('service.edit', $id)->withInput()->with('success', 'The service has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Services::where('Guid', $id)->first();
        $oldImage = "uploads/services/$service->Image";
        if($service )
        {
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            Services::where('Guid', $id)->delete();
            return redirect()->route('service.index')->withInput()->with('success', 'The service has been deleted successfully');

        }else{

            return redirect()->route('service.index')->withInput()->with('error', 'An error while deleting service'); 
        }
        
    }
}
