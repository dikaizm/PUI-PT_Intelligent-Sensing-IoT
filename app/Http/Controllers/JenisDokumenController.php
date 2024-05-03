<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use Illuminate\Http\Request;
use App\Http\Requests\JenisDokumenRequest;

class JenisDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengaturan-jenis-dokumen.index', [
            'jenis_dokumen' => JenisDokumen::all(),
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
    public function store(JenisDokumenRequest $request)
    {
        JenisDokumen::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('jenis-dokumen.index')
            ->with('success', 'Jenis dokumen berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisDokumen $jenisDokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisDokumen $jenisDokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisDokumenRequest $request, string $id)
    {
        JenisDokumen::where('id', $id)->update([
            'name' => $request->name,
        ]);
        return redirect()
            ->route('jenis-dokumen.index')
            ->with('success', 'Jenis dokumen berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        JenisDokumen::findOrFail($id)->delete();
        return redirect()
            ->route('jenis-dokumen.index')
            ->with('success', 'Jenis dokumen berhasil dihapus!');
    }
}
