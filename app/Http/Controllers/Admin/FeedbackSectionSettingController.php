<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeedbackSectionSetting;
use Illuminate\Http\Request;

class FeedbackSectionSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbackSectionSetting = FeedbackSectionSetting::first();
        return view('admin.feedback-section-setting.index',compact('feedbackSectionSetting'));
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
            'title' => ['required','max:200'],
            'subtitle' => ['required','max:500']
        ]);

        FeedbackSectionSetting::updateOrCreate(
            ['id' => $id],
            [
                'title'  => $request->title,
                'subtitle'  => $request->subtitle,
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
