<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FooterHelpLinkDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterHelpLink;
use Illuminate\Http\Request;

class FooterHelpLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterHelpLinkDataTable $dataTable)
    {
        return $dataTable->render('admin.footer-help-link.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer-help-link.create');
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

        $create = new FooterHelpLink();
        $create -> name = $request -> name;
        $create -> url = $request -> url;
        $create -> save();

        \Flasher\Toastr\Prime\toastr()->success('Footer Help Link Created Successfully');

        return redirect()->route('admin.footer-help-link.index');
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
        $footerHelpLink = FooterHelpLink::findOrFail($id);
        return view('admin.footer-help-link.edit', compact('footerHelpLink','id'));
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
        $edit = FooterHelpLink::findOrFail($id);

        $edit -> name = $request -> name;
        $edit -> url = $request -> url;
        $edit -> save();

        \Flasher\Toastr\Prime\toastr()->success('Help Link Updated Successfully',['Congratulations!']);

        return redirect()->route('admin.footer-help-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = FooterHelpLink::findOrFail($id);
        $delete -> delete();
    }
}
