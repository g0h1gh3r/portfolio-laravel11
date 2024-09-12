<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PortfolioItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PortfolioItemDataTable $dataTable)
    {
        return $dataTable->render('admin.portfolio-item.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.portfolio-item.create',compact('categories'));
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
            'client' => ['max:200'],
            'website' => ['url'],

        ]);
        $imagePath = handleUpload('image');
        $create = new PortfolioItem();
        $create -> image = $imagePath;
        $create -> title = $request -> title;
        $create -> category_id = $request -> category_id;
        $create -> description = $request -> description;
        $create -> client = $request -> client;
        $create -> website = $request -> website;
        $create -> save();

        \Flasher\Toastr\Prime\toastr()->success('Portfolio Item Created Successfully');

        return redirect()->route('admin.portfolio-item.index');
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
        $portfolioItem = PortfolioItem::findOrFail($id);
        $categories = Category::all();
        return view('admin.portfolio-item.edit',compact('id','categories','portfolioItem'));
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
            'client' => ['max:200'],
            'website' => ['url'],

        ]);
        $edit = PortfolioItem::findOrFail($id);
        $imagePath = handleUpload('image',$edit);
        $edit -> image = $imagePath ?? $edit -> image;
        $edit -> title = $request -> title;
        $edit -> category_id = $request -> category_id;
        $edit -> description = $request -> description;
        $edit -> client = $request -> client;
        $edit -> website = $request -> website;
        $edit -> save();

        \Flasher\Toastr\Prime\toastr()->success('Portfolio Item Updated Successfully',['Congratulations!']);

        return redirect()->route('admin.portfolio-item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = PortfolioItem::findOrFail($id);
        deleteFileIfExist($delete->image);
        $delete -> delete();
    }
}
