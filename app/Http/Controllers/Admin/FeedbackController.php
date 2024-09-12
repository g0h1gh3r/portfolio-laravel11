<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FeedbackDataTable;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FeedbackDataTable $dataTable)
    {
        return $dataTable->render('admin.feedback.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:50'],
            'position' => ['required','max:100'],
            'description' => ['required','max:1000'],
        ]);

        $create = new Feedback();
        $create -> name = $request -> name;
        $create -> position = $request -> position;
        $create -> description = $request -> description;
        $create -> save();

        \Flasher\Toastr\Prime\toastr()->success('Feedback Created Successfully');

        return redirect()->route('admin.feedback.index');
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
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedback.edit',compact('id','feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','max:50'],
            'position' => ['required','max:100'],
            'description' => ['required','max:1000'],
        ]);
        $edit = Feedback::findOrFail($id);

        $edit -> name = $request -> name;
        $edit -> position = $request -> position;
        $edit -> description = $request -> description;
        $edit -> save();

        \Flasher\Toastr\Prime\toastr()->success('Feedback Updated Successfully',['Congratulations!']);

        return redirect()->route('admin.feedback.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Feedback::findOrFail($id);
        $delete -> delete();
    }
}
