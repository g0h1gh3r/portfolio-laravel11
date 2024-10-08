<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SkillItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\SkillItem;
use Illuminate\Http\Request;

class SkillItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SkillItemDataTable $dataTable)
    {
        return $dataTable->render('admin.skill-item.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skill-item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:200'],
            'percent' => ['required','numeric','between:0,100'],
        ]);
        $skillItem = new SkillItem();
        $skillItem->name = $request->name;
        $skillItem->percent = $request->percent;
        $skillItem->save();

        \Flasher\Toastr\Prime\toastr()->success('Created Successfully',['success']);
        return redirect()->route('admin.skill-item.index');
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
        $skillItem = SkillItem::findOrFail($id);
        return view('admin.skill-item.edit',compact('id','skillItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','max:200'],
            'percent' => ['required','numeric','between:0,100'],
        ]);
        $skillItem = SkillItem::findOrFail($id);
        $skillItem->name = $request->name;
        $skillItem->percent = $request->percent;
        $skillItem->save();

        \Flasher\Toastr\Prime\toastr()->success('Updated Successfully',['success']);
        return redirect()->route('admin.skill-item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = SkillItem::findOrFail($id);
        $delete->delete();
    }
}
