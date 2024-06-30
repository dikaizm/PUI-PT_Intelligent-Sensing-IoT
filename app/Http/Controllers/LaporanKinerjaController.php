<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Output;
use App\Models\Penelitian;
use App\Models\OutputDetail;
use App\Models\TargetPenelitian;
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

        $user = auth()->user();
        $isAdminOrKaur = $user->hasRole(['Admin', 'Kaur']);

        // Penelitian query
        $penelitianQuery = Penelitian::query()->where('output_only', false);
        if (!$isAdminOrKaur) {
            $penelitianQuery->whereHas('authors', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $penelitianToday = $penelitianQuery->clone()->whereDate('created_at', $today)->count();
        $penelitianYesterday = $penelitianQuery->clone()->whereDate('created_at', $yesterday)->count();
        $penelitianTahunAwal = $penelitianQuery->clone()->whereYear('created_at', $tahunAwal)->count();
        $penelitianTahunAkhir = $penelitianQuery->clone()->whereYear('created_at', $tahunAkhir)->count();

        // Output query
        $outputQuery = OutputDetail::query();
        if (!$isAdminOrKaur) {
            $outputQuery->whereHas('output.penelitian.authors', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $outputToday = $outputQuery->clone()->whereDate('created_at', $today)->count();
        $outputYesterday = $outputQuery->clone()->whereDate('created_at', $yesterday)->count();
        $outputTahunAwal = $outputQuery->clone()->whereYear('created_at', $tahunAwal)->count();
        $outputTahunAkhir = $outputQuery->clone()->whereYear('created_at', $tahunAkhir)->count();

        $quarters = [
            'Q1' => ['-01-01 00:00:00', '-03-31 23:59:59'],
            'Q2' => ['-04-01 00:00:00', '-06-30 23:59:59'],
            'Q3' => ['-07-01 00:00:00', '-09-30 23:59:59'],
            'Q4' => ['-10-01 00:00:00', '-12-31 23:59:59'],
        ];

        // Quarterly counts for Penelitian
        $penelitianThnAwal = $penelitianQuery->clone()->whereYear('created_at', $tahunAwal)->get();
        $penelitianThnAkhir = $penelitianQuery->clone()->whereYear('created_at', $tahunAkhir)->get();

        // Quarterly counts for Output
        $outputThnAwal = $outputQuery->clone()->whereYear('created_at', $tahunAwal)->get();
        $outputThnAkhir = $outputQuery->clone()->whereYear('created_at', $tahunAkhir)->get();

        $penelitianAwalQrt = [];
        $penelitianAkhirQrt = [];
        $outputAwalQrt = [];
        $outputAkhirQrt = [];

        foreach ($quarters as $quarter => $dates) {
            $penelitianAwalQrt[$quarter] = $penelitianThnAwal->whereBetween('created_at', [$tahunAwal . $dates[0], $tahunAwal . $dates[1]])->count();
            $penelitianAkhirQrt[$quarter] = $penelitianThnAkhir->whereBetween('created_at', [$tahunAkhir . $dates[0], $tahunAkhir . $dates[1]])->count();

            $outputAwalQrt[$quarter] = $outputThnAwal->whereBetween('created_at', [$tahunAwal . $dates[0], $tahunAwal . $dates[1]])->count();
            $outputAkhirQrt[$quarter] = $outputThnAkhir->whereBetween('created_at', [$tahunAkhir . $dates[0], $tahunAkhir . $dates[1]])->count();
        }

        // dd($penelitianAwalQrt, $penelitianAkhirQrt, $outputAwalQrt, $outputAkhirQrt);

        // Hitung jumlah penelitian berdasarkan nama status (1 sampai 6)
        $statusNames = ['Submitted', 'Review', 'Accepted', 'Rejected', 'On Going', 'Finished'];

        $statusCountsPenelitianQuery = Penelitian::select('status_penelitian.name', DB::raw('count(*) as total'))
            ->join('status_penelitian', 'penelitian.status_penelitian_id', '=', 'status_penelitian.id')
            ->whereIn(DB::raw('YEAR(penelitian.created_at)'), [$tahunAwal, $tahunAkhir])
            ->whereIn('status_penelitian.name', $statusNames)
            ->where('output_only', false) // Add this line to filter based on output_only = false
            ->groupBy('status_penelitian.name');

        if (!$isAdminOrKaur) {
            $statusCountsPenelitianQuery->whereHas('authors', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $statusCountsPenelitian = $statusCountsPenelitianQuery->pluck('total', 'status_penelitian.name')->toArray();

        // Pastikan semua status dari 1 sampai 6 ada di array
        $statusCountsPenelitian = array_replace(array_fill_keys($statusNames, 0), $statusCountsPenelitian);

        // Hitung jumlah output berdasarkan jenis (1 sampai 5)
        $statusCountsOutputQuery = OutputDetail::select('jo.jenis_output_key_id', DB::raw('count(*) as total'))
            ->join('jenis_output as jo', 'output_detail.jenis_output_id', '=', 'jo.id')
            ->whereYear('output_detail.created_at', $tahunAwal)
            ->groupBy('jo.jenis_output_key_id');

        if (!$isAdminOrKaur) {
            $statusCountsOutputQuery->whereHas('output.penelitian.authors', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $statusCountsOutput = $statusCountsOutputQuery->pluck('total', 'jo.jenis_output_key_id')->toArray();

        // Pastikan semua jenis dari 1 sampai 5 ada di array
        $statusCountsOutput = array_replace([1 => 0, 2 => 0, 3 => 0, 4 => 0], $statusCountsOutput);

        $statusCountsOutputAwal = $statusCountsOutputQuery->clone()->whereYear('output_detail.created_at', $tahunAwal)->pluck('total', 'jo.jenis_output_key_id')->toArray();
        $statusCountsOutputAkhir = $statusCountsOutputQuery->clone()->whereYear('output_detail.created_at', $tahunAkhir)->pluck('total', 'jo.jenis_output_key_id')->toArray();

        // Ambil target penelitian dari tabel atau set default target
        $targetPenelitian = TargetPenelitian::whereIn('tahun', [$tahunAwal, $tahunAkhir])->pluck('target', 'tahun')->toArray();

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
            'target_penelitian' => json_encode($targetPenelitian), // Encode data Status Output to JSON
            'penelitian_awal_qrt' => json_encode($penelitianAwalQrt),
            'penelitian_akhir_qrt' => json_encode($penelitianAkhirQrt),
            'output_awal_qrt' => json_encode($outputAwalQrt),
            'output_akhir_qrt' => json_encode($outputAkhirQrt),
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
            'tahun' => 'nullable|integer|min:' . date('Y') . '|max:' . (date('Y') + 20),
            'targetPenelitian' => 'nullable|integer|min:0',
        ]);

        if ($request->input('tahun') && $request->input('targetPenelitian')) {
            TargetPenelitian::updateOrCreate(
                ['tahun' => $request->input('tahun')],
                ['target' => $request->input('targetPenelitian')]
            );
        }
        // Redirect ke index dengan tahun yang dipilih
        return redirect()->route('laporan-kinerja.index', [
            'tahunAwal' => $request->input('tahunAwal'),
            'tahunAkhir' => $request->input('tahunAkhir')
        ])->with('success', 'Laporan Kinerja berhasil diperbarui.');
    }

    public function getTargetPenelitian()
    {
        return response()->json(TargetPenelitian::all()->pluck('target', 'tahun'));
    }
    /**
     * Display the specified resource.
     */

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
