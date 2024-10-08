<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FooterSocialLinkDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterSocialLink;
use Illuminate\Http\Request;

class FooterSocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterSocialLinkDataTable $dataTable)
    {
        return $dataTable->render('admin.footer-social-link.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer-social-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => ['required'],
            'url' => ['required','url'],
        ]);

        $create = new FooterSocialLink();
        $create -> icon = $request -> icon;
        $create -> url = $request -> url;
        $create -> save();

        \Flasher\Toastr\Prime\toastr()->success('Footer Social Link Created Successfully');

        return redirect()->route('admin.footer-social-link.index');
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
        $footerSocialLink = FooterSocialLink::findOrFail($id);
        return view('admin.footer-social-link.edit',compact('id','footerSocialLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required'],
            'url' => ['required','url'],
        ]);
        $edit = FooterSocialLink::findOrFail($id);

        $edit -> icon = $request -> icon;
        $edit -> url = $request -> url;
        $edit -> save();

        \Flasher\Toastr\Prime\toastr()->success('Social Link Updated Successfully',['Congratulations!']);

        return redirect()->route('admin.footer-social-link.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = FooterSocialLink::findOrFail($id);
        $delete -> delete();
    }
}
