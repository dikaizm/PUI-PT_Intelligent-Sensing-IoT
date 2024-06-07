<?php

namespace App\Http\Controllers;

use App\Models\Output;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('output.index', [
            'output' => auth()->user()->hasRole('Admin')
                ? Output::with(['penelitian', 'outputDetails'])
                    ->whereHas('penelitian', function ($query) {
                        $query->where('arsip', false);
                    })
                    ->paginate(5)
                : Output::with([
                    'penelitian',
                    'outputDetails',
                    'penelitian.users',
                ])
                    ->whereHas('penelitian', function ($query) {
                        $query->where('arsip', false);
                    })
                    ->whereHas('penelitian.users', function ($query) {
                        $query->where('users.id', auth()->user()->id);
                    })
                    ->paginate(5),
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
    public static function store(string $penelitian_id)
    {
        $output = Output::firstOrCreate(['penelitian_id' => $penelitian_id]);

        return $output;
    }

    /**
     * Display the specified resource.
     */
    public function show(Output $output)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Output $output)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Output $output)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Output $output)
    {
        //
    }
}
