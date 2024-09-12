<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use function Termwind\render;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.portfolio-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portfolio-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:200']
        ]);
        $create = new Category();
        $create -> name = $request->name;
        $create->slug = \Str::slug($request->name);
        $create -> save();

        \Flasher\Toastr\Prime\toastr()->success('Created Successfully',['Congratulations!']);

        return redirect()->route('admin.portfolio-category.index');
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
        $category = Category::findOrFail($id);
        return view('admin.portfolio-category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','max:200']
        ]);

        $edit = Category::findOrFail($id);
        $edit -> name = $request -> name;
        $edit -> slug = \Str::slug($request -> name);
        $edit -> save();
        toastr()->success('Updated Successfully');
        return redirect()->route('admin.portfolio-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Category::findOrFail($id);
        $hasItem = PortfolioItem::where('category_id',$id)->count();
        if($hasItem == 0){
            $delete -> delete();
            return true;
        }
        else
            return response(['status' => 'error']);
    }
}
