<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;
use App\Http\Requests\SkemaRequest;

class SkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-skema.index', [
            'skema' => Skema::all(),
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
    public function store(SkemaRequest $request)
    {
        Skema::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('skema.index')
            ->with('success', 'skema berhasil ditambah!');
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
    public function update(SkemaRequest $request, string $id)
    {
        Skema::where('id', $id)->update(['name' => $request->name]);

        return redirect()
            ->route('skema.index')
            ->with('success', 'Skema berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Skema::findOrFail($id)->delete();

        return redirect()
            ->route('skema.index')
            ->with('success', 'Skema berhasil dihapus!');
    }
}
