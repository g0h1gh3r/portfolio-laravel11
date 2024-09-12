<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generalSetting = GeneralSetting::first();
        return view('admin.setting.general-setting.index', compact('generalSetting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo'=>['image','max:5000'],
            'footer_logo'=>['image','max:5000'],
            'favicon'=>['image','max:5000'],
        ]);

        $generalSetting = GeneralSetting::first();
        $logo = handleUpload('logo', $generalSetting);
        $footer_logo = handleUpload('footer_logo', $generalSetting);
        $favicon = handleUpload('favicon', $generalSetting);


        GeneralSetting::updateOrCreate(
            ['id' => $id],
            [
                'logo' => $logo ?? $generalSetting->logo,
                'footer_logo' => $footer_logo ?? $generalSetting->footer_logo,
                'favicon' => $favicon ?? $generalSetting->favicon,
            ]
        );
        \Flasher\Toastr\Prime\toastr()->success('Updated Successfully!',['Congratulations!']);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
