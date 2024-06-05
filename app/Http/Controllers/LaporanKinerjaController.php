<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Output;
use App\Models\Penelitian;
use App\Models\OutputDetail;
use Illuminate\Http\Request;

class LaporanKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        //Penelitian
        $penelitianToday = Penelitian::whereDate('created_at', $today)->count();
        $penelitianYesterday = Penelitian::whereDate(
            'created_at',
            $yesterday
        )->count();

        //output
        $outputToday = OutputDetail::whereDate('created_at', $today)->count();
        $outputYesterday = OutputDetail::whereDate(
            'created_at',
            $yesterday
        )->count();

        //

        return view('admin.laporan-kinerja', [
            'jumlah_penelitian' => Penelitian::count(),
            'jumlah_output' => OutputDetail::count(),
            'difference_jumlah_penelitian' =>
                $penelitianToday - $penelitianYesterday,
            'difference_jumlah_output' => $outputToday - $outputYesterday,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
