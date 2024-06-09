<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Output;
use App\Models\Penelitian;
use App\Models\OutputDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanKinerjaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tahun yang dipilih dari request, atau gunakan tahun ini sebagai default
        $tahun = $request->input('tahun', date('Y'));
        $tahunAwal = $request->input('tahunAwal', date('Y'));
        $tahunAkhir = $request->input('tahunAkhir', date('Y') + 1);

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Penelitian
        $penelitianToday = Penelitian::whereDate('created_at', $today)->count();
        $penelitianYesterday = Penelitian::whereDate('created_at', $yesterday)->count();
        $penelitianTahunAwal = Penelitian::whereYear('created_at', $tahunAwal)->count();
        $penelitianTahunAkhir = Penelitian::whereYear('created_at', $tahunAkhir)->count();


        // Output
        $outputToday = OutputDetail::whereDate('created_at', $today)->count();
        $outputYesterday = OutputDetail::whereDate('created_at', $yesterday)->count();
        $outputTahunAwal = OutputDetail::whereYear('created_at', $tahunAwal)->count();
        $outputTahunAkhir = OutputDetail::whereYear('created_at', $tahunAkhir)->count();

        // Hitung jumlah penelitian berdasarkan nama status (1 sampai 6)
        $statusNames = ['Submitted', 'Review', 'Accepted', 'Rejected', 'On Going', 'Finished'];

        $statusCountsPenelitian = Penelitian::select('status_penelitian.name', DB::raw('count(*) as total'))
        ->join('status_penelitian', 'penelitian.status_penelitian_id', '=', 'status_penelitian.id')
        ->whereIn(DB::raw('YEAR(penelitian.created_at)'), [$tahunAwal, $tahunAkhir])
        ->whereIn('status_penelitian.name', $statusNames)
        ->groupBy('status_penelitian.name')
        ->pluck('total', 'status_penelitian.name')
        ->toArray();

        // Pastikan semua status dari 1 sampai 6 ada di array
        $statusCountsPenelitian = array_replace(array_fill_keys($statusNames, 0), $statusCountsPenelitian);

        // Hitung jumlah output berdasarkan jenis (1 sampai 5)
        $statusCountsOutput = OutputDetail::select('jenis_output_id', DB::raw('count(*) as total'))
        ->whereIn(DB::raw('YEAR(created_at)'), [$tahunAwal, $tahunAkhir])
        ->whereIn('jenis_output_id', [1, 2, 3, 4])
        ->groupBy('jenis_output_id')
        ->pluck('total', 'jenis_output_id')
        ->toArray();

        // Pastikan semua jenis dari 1 sampai 5 ada di array
        $statusCountsOutput = array_replace([1 => 0, 2 => 0, 3 => 0, 4 => 0], $statusCountsOutput);

        // Output berdasarkan tahun
        $statusCountsOutputAwal = OutputDetail::select('jenis_output_id', DB::raw('count(*) as total'))
        ->whereYear('created_at', $tahunAwal)
        ->groupBy('jenis_output_id')
        ->pluck('total', 'jenis_output_id')
        ->toArray();

        $statusCountsOutputAkhir = OutputDetail::select('jenis_output_id', DB::raw('count(*) as total'))
        ->whereYear('created_at', $tahunAkhir)
        ->groupBy('jenis_output_id')
        ->pluck('total', 'jenis_output_id')
        ->toArray();

        // Pastikan semua jenis dari 1 sampai 4 ada di array
        $statusCountsOutputAwal = array_replace([1 => 0, 2 => 0, 3 => 0, 4 => 0], $statusCountsOutputAwal);
        $statusCountsOutputAkhir = array_replace([1 => 0, 2 => 0, 3 => 0, 4 => 0], $statusCountsOutputAkhir);

        // Data yang akan dikirim ke view
        return view('admin.laporan-kinerja', [
            'jumlah_penelitian' => $penelitianTahunAwal + $penelitianTahunAkhir,
            'jumlah_output' => $outputTahunAwal + $outputTahunAkhir,
            'difference_jumlah_penelitian' => $penelitianToday - $penelitianYesterday,
            'difference_jumlah_output' => $outputToday - $outputYesterday,
            'status_counts_penelitian' => json_encode($statusCountsPenelitian), // Encode data Status Penelitian to JSON
            'status_counts_output' => json_encode($statusCountsOutput), // Encode data Jenis Output to JSON
            'tahun' => $tahun,
            'tahun_awal' => $tahunAwal,
            'tahun_akhir' => $tahunAkhir,
            'penelitian_tahun_awal' => $penelitianTahunAwal,
            'penelitian_tahun_akhir' => $penelitianTahunAkhir,
            'status_counts_output_awal' => json_encode($statusCountsOutputAwal), // Encode data Status Output to JSON
            'status_counts_output_akhir' => json_encode($statusCountsOutputAkhir), // Encode data Status Output to JSON
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
        // Validasi dan proses data request di sini
        $request->validate([
            'tahun' => 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 100),
        ]);

        // Redirect ke index dengan tahun yang dipilih
        return redirect()->route('laporan-kinerja.index', ['tahun' => $request->input('tahun')])
            ->with('success', 'Laporan Kinerja berhasil diperbarui.');
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
