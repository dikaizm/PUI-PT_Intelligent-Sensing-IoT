<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JenisOutput;
use App\Models\OutputDetail;
use App\Models\StatusOutput;
use Illuminate\Http\Request;

class OutputDetailController extends Controller
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
        return view('output.tambah-data-output', [
            'jenis_output' => JenisOutput::with('jenisOutputKey')->get(),
            'status_output' => StatusOutput::all(),
            'tipe' => OutputType::getValues(),
            'users' => User::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OutputDetail $outputDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OutputDetail $outputDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OutputDetail $outputDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OutputDetail $outputDetail)
    {
        //
    }
}
