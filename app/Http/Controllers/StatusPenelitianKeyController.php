<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusPenelitianKey;
use App\Http\Requests\StatusPenelitianKeyRequest;

class StatusPenelitianKeyController extends Controller
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
    public function store(StatusPenelitianKeyRequest $request)
    {
        StatusPenelitianKey::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('status-penelitian.index')
            ->with('success', 'Key berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusPenelitianKey $statusPenelitianKey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusPenelitianKey $statusPenelitianKey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusPenelitianKeyRequest $request, string $id)
    {
        StatusPenelitianKey::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('status-penelitian.index')
            ->with('success', 'Key berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StatusPenelitianKey::findOrFail($id)->delete();

        return redirect()
            ->route('status-penelitian.index')
            ->with('success', 'Key berhasil dihapus!');
    }
}
