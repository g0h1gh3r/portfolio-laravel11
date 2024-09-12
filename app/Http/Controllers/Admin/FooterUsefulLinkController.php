<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FooterSocialLinkDataTable;
use App\DataTables\FooterUsefulLinkDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterSocialLink;
use App\Models\FooterUsefulLink;
use Illuminate\Http\Request;

class FooterUsefulLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterUsefulLinkDataTable $dataTable)
    {
        return $dataTable->render('admin.footer-useful-link.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer-useful-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'url' => ['required','url'],
        ]);

        $create = new FooterUsefulLink();
        $create -> name = $request -> name;
        $create -> url = $request -> url;
        $create -> save();

        \Flasher\Toastr\Prime\toastr()->success('Footer Useful Link Created Successfully');

        return redirect()->route('admin.footer-useful-link.index');
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
        $footerUsefulLink = FooterUsefulLink::findOrFail($id);
        return view('admin.footer-useful-link.edit', compact('footerUsefulLink','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'url' => ['required','url'],
        ]);
        $edit = FooterUsefulLink::findOrFail($id);

        $edit -> name = $request -> name;
        $edit -> url = $request -> url;
        $edit -> save();

        \Flasher\Toastr\Prime\toastr()->success('Useful Link Updated Successfully',['Congratulations!']);

        return redirect()->route('admin.footer-useful-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = FooterUsefulLink::findOrFail($id);
        $delete -> delete();
    }
}
