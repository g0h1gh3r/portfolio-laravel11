<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experience = Experience::first();
        return view('admin.experience.index',compact('experience'));
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
            'description' => ['required','max:2000'],
            'image' => ['image','max:5000'],
            'phone' => ['nullable','max:20'],
            'email' => ['nullable','email','max:200'],
        ]);
        $experience = Experience::first();
        $imagePath = handleUpload('image',$experience);

        Experience::updateOrCreate(
            ['id' => $id],
            [
                'title'  => $request->title,
                'description'  => $request->description,
                'phone' => $request->phone,
                'email' => $request->email,
                'image' => $imagePath ?? $experience->image,
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
