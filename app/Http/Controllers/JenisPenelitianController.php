<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPenelitian;
use App\Http\Requests\JenisPenelitianRequest;

class JenisPenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengaturan-jenis-penelitian.index', [
            'jenis_penelitian' => JenisPenelitian::all(),
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
    public function store(JenisPenelitianRequest $request)
    {
        JenisPenelitian::create([
            'name' => $request->name,
        ]);
        return redirect()
            ->route('jenis-penelitian.index')
            ->with('success', 'Jenis Penelitian berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisPenelitian $jenisPenelitian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisPenelitian $jenisPenelitian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisPenelitianRequest $request, string $id)
    {
        JenisPenelitian::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('jenis-penelitian.index')
            ->with('success', 'Jenis Penelitian berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis_penelitian = JenisPenelitian::findOrFail($id);
        $jenis_penelitian->delete();

        return redirect()
            ->route('jenis-penelitian.index')
            ->with('success', 'Jenis Penelitian berhasil dihapus!');
    }
}
