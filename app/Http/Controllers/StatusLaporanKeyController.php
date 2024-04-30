<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusLaporanKey;
use App\Http\Requests\StatusLaporanKeyRequest;

class StatusLaporanKeyController extends Controller
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
    public function store(StatusLaporanKeyRequest $request)
    {
        StatusLaporanKey::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('status-laporan.index')
            ->with('success', 'Key berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusLaporanKey $statusLaporanKey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusLaporanKey $statusLaporanKey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusLaporanKeyRequest $request, string $id)
    {
        StatusLaporanKey::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('status-laporan.index')
            ->with('success', 'Key berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StatusLaporanKey::findOrFail($id)->delete();

        return redirect()
            ->route('status-laporan.index')
            ->with('success', 'Key berhasil dihapus!');
    }
}
