<?php

namespace App\Http\Controllers;

use App\Models\StatusJurnal;
use Illuminate\Http\Request;
use App\Http\Requests\StatusJurnalRequest;

class StatusJurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengaturan-status-jurnal.index', [
            'status_jurnal' => StatusJurnal::all(),
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
    public function store(StatusJurnalRequest $request)
    {
        StatusJurnal::create(['name' => $request->name]);

        return redirect()
            ->route('status-jurnal.index')
            ->with('success', 'Status Jurnal berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusJurnal $statusJurnal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusJurnal $statusJurnal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusJurnalRequest $request, string $id)
    {
        StatusJurnal::where('id', $id)->update(['name' => $request->name]);

        return redirect()
            ->route('status-jurnal.index')
            ->with('success', 'Status Jurnal berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StatusJurnal::findOrFail($id)->delete();

        return redirect()
            ->route('status-jurnal.index')
            ->with('success', 'Status Jurnal berhasil dihapus!');
    }
}
