<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisOutputKey;
use App\Http\Requests\JenisOutputKeyRequest;

class JenisOutputKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(JenisOutputKeyRequest $request)
    {
        JenisOutputKey::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('jenis-output.index')
            ->with('success', 'Jenis Output Key berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisOutputKey $jenisOutputKey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisOutputKey $jenisOutputKey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisOutputKeyRequest $request, string $id)
    {
        JenisOutputKey::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('jenis-output.index')
            ->with('success', 'Jenis Output Key berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        JenisOutputKey::findOrFail($id)->delete();

        return redirect()
            ->route('jenis-output.index')
            ->with('success', 'Jenis Output Key berhasil dihapus!');
    }
}
