<?php

namespace App\Http\Controllers;

use App\Models\JenisOutput;
use Illuminate\Http\Request;
use App\Http\Requests\JenisOutputRequest;

class JenisOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengaturan-jenis-output.index', [
            'jenis_outputs' => JenisOutput::all(),
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
    public function store(JenisOutputRequest $request)
    {
        JenisOutput::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('jenis-output.index')
            ->with('success', 'Jenis output berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisOutput $jenisOutput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisOutput $jenisOutput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisOutputRequest $request, string $id)
    {
        JenisOutput::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('jenis-output.index')
            ->with('success', 'Jenis Output berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis_output = JenisOutput::findOrFail($id);
        $jenis_output->delete();

        return redirect()
            ->route('jenis-output.index')
            ->with('success', 'Jenis Output berhasil dihapus!');
    }
}
