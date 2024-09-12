<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.blog-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:200']
        ]);
        $create = new BlogCategory();
        $create -> name = $request->name;
        $create->slug = \Str::slug($request->name);
        $create -> save();

        \Flasher\Toastr\Prime\toastr()->success('Created Successfully',['Congratulations!']);

        return redirect()->route('admin.blog-category.index');
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
        $blogCategory = BlogCategory::findOrFail($id);
        return view('admin.blog-category.edit',compact('blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','max:200']
        ]);

        $edit = BlogCategory::findOrFail($id);
        $edit -> name = $request -> name;
        $edit -> slug = \Str::slug($request -> name);
        $edit -> save();
        toastr()->success('Updated Successfully');
        return redirect()->route('admin.blog-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = BlogCategory::findOrFail($id);
        $hasItem = Blog::where('category_id',$id)->count();
        if($hasItem == 0){
            $delete -> delete();
            return true;
        }
        else
            return response(['status' => 'error']);
    }
}
