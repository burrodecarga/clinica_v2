<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicines = Medicine::all();
        return view('medicines.index', compact('medicines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicine = new Medicine();
        $title = "medicine create";
        $btn = "create";
        return view('medicines.create', compact('medicine', 'title', 'btn'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|unique:medicines,name',
        ]);
        $name = $request->input('name');
        $active = $request->input('active');
        $presentation = $request->input('presentation');
        $via = $request->input('via');
        $medicine = Medicine::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'active' => $active,
            'presentation' => $presentation,
            'via' => $via,

        ]);
        return redirect()->route('medicines.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        $title = "medicine show";
        $btn = "show";
        return view('medicines.show', compact('medicine', 'title', 'btn'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        $title = "medicine edit";
        $btn = "edit";
        return view('medicines.edit', compact('medicine', 'title', 'btn'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required|unique:medicines,name,' . $medicine->id,
        ]);

        $name = $request->input('name');
        $active = $request->input('active');
        $presentation = $request->input('presentation');
        $via = $request->input('via');
        // dd($request->all());
        $medicine->name = $name;
        $medicine->active = $active;
        $medicine->presentation = $presentation;
        $medicine->via = $via;
        $medicine->slug = Str::slug($name);
        $medicine->save();
        return redirect()->route('medicines.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.index');
    }
}
