<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use App\Http\Requests\MitraRequest;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengaturan-mitra.index', [
            'mitra' => Mitra::all(),
        ]);
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
    public function store(MitraRequest $request)
    {
        Mitra::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('mitra.index')
            ->with('success', 'Mitra berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mitra $mitra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mitra $mitra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MitraRequest $request, string $id)
    {
        Mitra::where('id', $id)->update(['name' => $request->name]);

        return redirect()
            ->route('mitra.index')
            ->with('success', 'Mitra berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Mitra::findOrFail($id)->delete();

        return redirect()
            ->route('mitra.index')
            ->with('success', 'Mitra berhasil dihapus!');
    }
}
