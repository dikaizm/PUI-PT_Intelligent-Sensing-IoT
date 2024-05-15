<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use App\Http\Requests\StorePenelitianRequest;
use App\Http\Requests\UpdatePenelitianRequest;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penelitian = auth()->user()->hasRole('Admin')
            ? Penelitian::where('arsip', false)
                ->with([
                    'statusPenelitian',
                    'statusPenelitian.statusPenelitianKey',
                ])
                ->get()
            : auth()
                ->user()
                ->penelitians()
                ->where('arsip', false)
                ->with([
                    'statusPenelitian',
                    'statusPenelitian.statusPenelitianKey',
                ])
                ->get();

        return view('penelitian.index', [
            'penelitian' => $penelitian,
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
    public function store(StorePenelitianRequest $request)
    {
        $penelitian = Penelitian::create([
            'skema' => $request->skema,
            'judul' => $request->judul,
            'tingkatan_tkt' => $request->tingkatan_tkt,
            'pendanaan' => $request->pendanaan,
            'jangka_waktu' => $request->jangka_waktu,
            'file' => $request->file,
            'feedback' => $request->feedback,
            'status_penelitian_id' => $request->status_penelitian_id,
            'jenis_penelitian' => $request->jenis_penelitian_id,
            'mitra_id' => $request->mitra_id,
        ]);

        $pivotData = [];
        foreach ($request->user_id as $index => $userId) {
            $pivotData[$userId] = [
                'is_ketua' => $request->is_ketua[$index],
            ];
        }

        $penelitian->users()->sync($pivotData);

        return redirect()
            ->route('penelitian.index')
            ->with('success', 'Penelitian berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penelitian $penelitian, $uuid)
    {
        return view('penelitian.show', [
            'penelitian' => $penelitian
                ->where('uuid', $uuid)
                ->with([
                    'statusPenelitian',
                    'statusPenelitian.statusPenelitianKey',
                    'jenisPenelitian',
                    'mitra',
                    'users',
                    'output',
                    'output.outputDetails',
                    'output.outputDetails.jenisDokumen',
                ])
                ->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penelitian $penelitian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenelitianRequest $request, $uuid)
    {
        $penelitian = Penelitian::where('uuid', $uuid)->get();

        $penelitian->update([
            'skema' => $request->skema,
            'judul' => $request->judul,
            'tingkatan_tkt' => $request->tingkatan_tkt,
            'pendanaan' => $request->pendanaan,
            'jangka_waktu' => $request->jangka_waktu,
            'file' => $request->file,
            'feedback' => $request->feedback,
            'status_penelitian_id' => $request->status_penelitian_id,
            'jenis_penelitian' => $request->jenis_penelitian_id,
            'mitra_id' => $request->mitra_id,
        ]);

        $pivotData = [];
        foreach ($request->user_id as $index => $userId) {
            $pivotData[$userId] = [
                'is_ketua' => $request->is_ketua[$index] ?? false,
                'is_corresponding' =>
                    $request->is_corresponding[$index] ?? false,
            ];
        }

        $penelitian->users()->sync($pivotData);

        return redirect()
            ->route('penelitian.index')
            ->with('success', 'Penelitian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penelitian $penelitian)
    {
        //
    }
}
