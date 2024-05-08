<?php

namespace App\Http\Controllers;

use App\Models\StatusOutput;
use Illuminate\Http\Request;
use App\Http\Requests\StatusOutputRequest;

class StatusOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengaturan-status-output.index', [
            'status_output' => StatusOutput::all(),
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
    public function store(StatusOutputRequest $request)
    {
        StatusOutput::create(['name' => $request->name]);

        return redirect()
            ->route('status-output.index')
            ->with('success', 'Status output berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusOutput $StatusOutput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusOutput $StatusOutput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusOutputRequest $request, string $id)
    {
        StatusOutput::where('id', $id)->update(['name' => $request->name]);

        return redirect()
            ->route('status-output.index')
            ->with('success', 'Status output berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StatusOutput::findOrFail($id)->delete();

        return redirect()
            ->route('status-output.index')
            ->with('success', 'Status output berhasil dihapus!');
    }
}
