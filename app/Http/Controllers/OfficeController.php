<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::latest()->paginate(10);
        return view('offices.index', compact('offices'));
    }

    public function create()
    {
        return view('offices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',   
            'radius' => 'required|numeric',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);


        Office::create($request->all());

        return redirect()->route('offices.index')
            ->with('success', 'Kantor berhasil ditambahkan');
    }

    public function edit(Office $office)
    {
        return view('offices.edit', compact('office'));
    }

    public function update(Request $request, Office $office)
    {
        $request->validate([
            'name' => 'required',
            'radius' => 'required|numeric'
        ]);

        $office->update($request->all());

        return redirect()->route('offices.index')
            ->with('success', 'Kantor berhasil diupdate');
    }

    public function destroy(Office $office)
    {
        $office->delete();

        return back()->with('success', 'Kantor dihapus');
    }
}
