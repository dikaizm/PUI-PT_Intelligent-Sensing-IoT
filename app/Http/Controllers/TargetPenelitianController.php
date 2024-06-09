<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TargetPenelitianController extends Controller
{
    public function index(Request $request)
    {
        $tahunAwal = $request->query('tahunAwal', date('Y'));
        $tahunAkhir = $request->query('tahunAkhir', date('Y') + 1);

        $targetPenelitian = json_decode(File::get(public_path('target_penelitian.json')), true);

        return view('admin.laporan-kinerja', [
            'tahun_awal' => $tahunAwal,
            'tahun_akhir' => $tahunAkhir,
            'target_penelitian' => $targetPenelitian,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 20),
            'feedback' => 'required|integer|min:0',
        ]);

        $targetPenelitian = json_decode(File::get(public_path('target_penelitian.json')), true);
        $targetPenelitian[$request->input('tahun')] = $request->input('feedback');

        File::put(public_path('target_penelitian.json'), json_encode($targetPenelitian, JSON_PRETTY_PRINT));

        return redirect()->route('laporan-kinerja.index')
            ->with('success', 'Target penelitian berhasil diperbarui.');
    }

    public function getTargetPenelitian()
    {
        return response()->json(json_decode(File::get(public_path('target_penelitian.json')), true));
    }
}
