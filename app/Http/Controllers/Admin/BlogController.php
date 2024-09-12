<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\FooterContactInfo;
use App\Models\FooterHelpLink;
use App\Models\FooterInfo;
use App\Models\FooterSocialLink;
use App\Models\FooterUsefulLink;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogDataTable $dataTable)
    {

        return $dataTable->render('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogCategories = BlogCategory::all();
        return view('admin.blog.create',compact('blogCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:5000'],
            'title' => ['required','max:200'],
            'category_id' => ['required','numeric'],
            'description' => ['required'],

        ]);

        $create = new Blog();
        $imagePath = handleUpload('image',$create);
        $create -> image = $imagePath;
        $create -> title = $request -> title;
        $create -> category_id = $request -> category_id;
        $create -> description = $request -> description;
        $create -> save();

        \Flasher\Toastr\Prime\toastr()->success('Blog Created Successfully');

        return redirect()->route('admin.blog.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blogCategories = BlogCategory::all();
        return view('admin.blog.edit',compact('blog','blogCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['image', 'max:5000'],
            'title' => ['required','max:200'],
            'category_id' => ['required','numeric'],
            'description' => ['required'],

        ]);

        $edit = Blog::findOrFail($id);
        $imagePath = handleUpload('image',$edit);
        $edit -> image = $imagePath ?? $edit -> image;
        $edit -> title = $request -> title;
        $edit -> category_id = $request -> category_id;
        $edit -> description = $request -> description;
        $edit -> save();

        \Flasher\Toastr\Prime\toastr()->success('Blog Updated Successfully');

        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Blog::findOrFail($id);
        deleteFileIfExist($delete->image);
        $delete -> delete();
    }
}
