<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $blog_table;

    public function __construct(){
      $this->blog_table='blogs';  
    }

    public function index()
    {
        $items = Blog::all()->sortByDesc("ID");
        return view('blogs.list-blogs', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.add-blog');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'Title' => 'required',
            'TitleAr'=>'required',
            'Image' => 'required',
            'Description'  => 'required',
            'DescriptionAr'=>'required',
            'Image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'TitleAr.required' => 'The title arabic field is required',
            'DescriptionAr.required' => 'The description arabic field is required'
        ]);
        $Guid = (string) Str::uuid();
        $input = $request->all();
        if ($image = $request->file('Image')) {
            $extainsion = $image->getClientOriginalExtension();
            $filename = $Guid . '-' . date('YmdHis') . "." . $extainsion;
            
            $image->move('uploads/blog', $filename);
            $input['image'] = $filename;
        }

        $data = [
            'Guid' => (string) Str::uuid(),
            'Title' => $input['Title'],
            'TitleAr' => $input['TitleAr'],
            'Slug'=>generateSlug($this->blog_table,'Title',$input['Title']),
            'SlugAr'=>generateSlugAr($this->blog_table,'TitleAr',$input['TitleAr']),
            'Description' => $input['Description'],
            'DescriptionAr' => $input['DescriptionAr'],
            'MetaTitle' => $input['MetaTitle'],
            'MetaTitleAr' => $input['MetaTitleAr'],
            'MetaDescription' => $input['MetaDescription'],
            'MetaDescriptionAr' => $input['MetaDescriptionAr'],
            'Image' =>  $input['image'],
            'Alt'=> $input['Alt'],
            'CreatedBy' =>'1',
            'ModifiedBy' =>'1',
            'IsEnable' =>1
        ];

        Blog::create($data);

        return redirect()->route('blog.create')->withInput()
            ->with('success', 'The blog has been added successfully');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $blog = Blog::where('Guid', $id)->first();
        // print_r($blog); exit;
        return view('blogs.edit-blog', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::where('Guid', $id)->first();
        $request->validate([
            'Title' => 'required',
            'Description'  => 'required',
            'TitleAr' => 'required',
            'DescriptionAr'  => 'required',
        ],[
            'TitleAr.required' => 'The title arabic field is required',
            'DescriptionAr.required' => 'The description arabic field is required'
        ]);
        $input = $request->all();
        if ($image = $request->file('Image')) {
            $oldImage = "uploads/blog/$blog->Image";
            if (File::exists($oldImage)) {
                unlink($oldImage);
            }
            $imageDestinationPath = 'uploads/blog';
            $postImage =(string) Str::uuid(). '-' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        } else {
            unset($input['image']);
        }

        $data = [
            'Title' => $input['Title'],
            'TitleAr' => $input['TitleAr'],
            'Slug'=>generateSlug($this->blog_table,'Title',$input['Title']),
            'SlugAr'=>generateSlugAr($this->blog_table,'TitleAr',$input['TitleAr']),
            'Description' => $input['Description'],
            'DescriptionAr' => $input['DescriptionAr'],
            'MetaTitle' => $input['MetaTitle'],
            'MetaTitleAr' => $input['MetaTitleAr'],
            'MetaDescription' => $input['MetaDescription'],
            'MetaDescriptionAr' => $input['MetaDescriptionAr'],
            'Alt'=> $input['Alt'],
            'CreatedBy' => '1',
            'ModifiedBy' => '1',
            'IsEnable' => empty($input['IsEnable']) ? 0 : 1
        ];
        if (!empty($input['image'])) {
            $data['Image'] = $input['image'];
        }
        Blog::whereId($blog->ID)->update($data);
        return redirect()->route('blog.edit', $id)->withInput()->with('success', 'The blog has been updated successfully');
    }

    public function destroy($id)
    {
        $blog = Blog::where('Guid', $id)->first();
        $oldImage = "uploads/blog/$blog->Image";
        if($blog )
        {
            if (File::exists($oldImage)) {
                unlink($oldImage);
            }
            Blog::where('Guid', $id)->delete();
            return redirect()->route('blog.index')->withInput()->with('success', 'The blog has been deleted successfully');

        }else{

            return redirect()->route('blog.index')->withInput()->with('error', 'An error while deleting blog'); 
        }
        
    }
}
