<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusPenelitian;
use App\Models\StatusPenelitianKey;
use App\Http\Requests\StatusPenelitianRequest;

class StatusPenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengaturan-status-penelitian.index', [
            'status_penelitian' => StatusPenelitian::with(
                'statusPenelitianKey'
            )->get(),
            'status_penelitian_key' => StatusPenelitianKey::all(),
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
    public function store(StatusPenelitianRequest $request)
    {
        StatusPenelitian::create([
            'status_penelitian_key_id' => $request->status_penelitian_key_id,
            'name' => $request->name,
            'warna' => $request->warna,
        ]);

        return redirect()
            ->route('status-penelitian.index')
            ->with('success', 'Status Penelitian berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusPenelitian $statusPenelitian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusPenelitian $statusPenelitian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusPenelitianRequest $request, string $id)
    {
        StatusPenelitian::where('id', $id)->update([
            'status_penelitian_key_id' => $request->status_penelitian_key_id,
            'warna' => $request->warna,
            'name' => $request->name,
        ]);

        return redirect()
            ->route('status-penelitian.index')
            ->with('success', 'Status Penelitian berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StatusPenelitian::findOrFail($id)->delete();

        return redirect()
            ->route('status-penelitian.index')
            ->with('success', 'Status Penelitian berhasil dihapus!');
    }
}
