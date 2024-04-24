<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use App\Models\JurnalArticle;

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
        $penelitianToday = JurnalArticle::whereDate(
            'created_at',
            $today
        )->count();
        $penelitianYesterday = JurnalArticle::whereDate(
            'created_at',
            $yesterday
        )->count();

        //Publikasi
        $publikasiToday = Publikasi::whereDate('created_at', $today)->count();
        $publikasiYesterday = Publikasi::whereDate(
            'created_at',
            $yesterday
        )->count();

        //user
        $userToday = User::whereDate('created_at', $today)->count();
        $userYesterday = User::whereDate('created_at', $yesterday)->count();

        return view('admin.laporan-kinerja', [
            'jumlah_penelitian' => JurnalArticle::count(),
            'jumlah_publikasi' => Publikasi::count(),
            'jumlah_user' => User::count(),
            'jumlah_penelitian_aktif' => JurnalArticle::whereHas(
                'statuslaporan',
                function ($query) {
                    $query->where('status_laporan_key_id', 2);
                }
            )->count(),
            'difference_jumlah_penelitian' =>
                $penelitianToday - $penelitianYesterday,
            'difference_jumlah_publikasi' =>
                $publikasiToday - $publikasiYesterday,
            'difference_jumlah_user' => $userToday - $userYesterday,
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
