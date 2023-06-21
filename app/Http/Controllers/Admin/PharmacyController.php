<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:pharmacies.index')->only('index');
        $this->middleware('can:pharmacies.create')->only('create');
        $this->middleware('can:pharmacies.store')->only('store');
        $this->middleware('can:pharmacies.show')->only('show');
        $this->middleware('can:pharmacies.update')->only('update');
        $this->middleware('can:pharmacies.edit')->only('edit');
        $this->middleware('can:pharmacies.destroy')->only('destroy');
    }

    public function index()
    {
        $pharmacies = Pharmacy::all();
        return view('admin.pharmacies.index', compact('pharmacies'));
    }

    public function create()
    {
        $pharmacy = new Pharmacy();
        $title = "pharmacy create";
        $btn = "create";
        return view('admin.pharmacies.create', compact('pharmacy', 'title', 'btn'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|unique:pharmacies,name',
        ]);
        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $mobil = $request->input('mobil');
        $pharmacy = Pharmacy::create([
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'mobil' => $mobil,

        ]);
        return redirect()->route('pharmacies.index');
    }

    public function edit(Pharmacy $pharmacy)
    {
        $title = "pharmacy edit";
        $btn = "update";
        return view('admin.pharmacies.edit', compact('pharmacy', 'title', 'btn'));
    }

    public function update(Request $request, Pharmacy $pharmacy)
    {
        //dd($pharmacy);
        $request->validate([
            'name' => 'required|unique:pharmacies,name,' . $pharmacy->id,
        ]);

        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $mobil = $request->input('mobil');
        // dd($request->all());
        $pharmacy->name = $name;
        $pharmacy->address = $address;
        $pharmacy->phone = $phone;
        $pharmacy->mobil = $mobil;
        $pharmacy->save();
        return redirect()->route('pharmacies.index');
    }

    public function destroy(Pharmacy $pharmacy)
    {
        if ($pharmacy->medicines == []) {$pharmacy->delete();}
        return redirect()->route('pharmacies.index');
    }

    public function show(Pharmacy $pharmacy)
    {
        $title = "pharmacy show";
        $btn = "show";
        return view('admin.pharmacies.show', compact('pharmacy', 'title', 'btn'));

    }

}
