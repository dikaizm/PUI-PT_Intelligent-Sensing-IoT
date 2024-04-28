<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusLaporan;
use App\Models\StatusLaporanKey;
use App\Http\Requests\StatusLaporanRequest;

class StatusLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengaturan-status-laporan.index', [
            'status_laporan' => StatusLaporan::with('statusLaporanKey')->get(),
            'status_laporan_key' => StatusLaporanKey::all(),
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
    public function store(StatusLaporanRequest $request)
    {
        StatusLaporan::create([
            'status_laporan_key_id' => $request->status_laporan_key_id,
            'name' => $request->name,
        ]);

        return redirect()
            ->route('status-laporan.index')
            ->with('success', 'Status Laporan berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusLaporan $statusLaporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusLaporan $statusLaporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusLaporanRequest $request, string $id)
    {
        StatusLaporan::where('id', $id)->update([
            'status_laporan_key_id' => $request->status_laporan_key_id,
            'name' => $request->name,
        ]);

        return redirect()
            ->route('status-laporan.index')
            ->with('success', 'Status Laporan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StatusLaporan::findOrFail($id)->delete();

        return redirect()
            ->route('status-laporan.index')
            ->with('success', 'Status Laporan berhasil dihapus!');
    }
}
