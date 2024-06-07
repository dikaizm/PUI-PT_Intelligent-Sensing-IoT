<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\OutputType;
use App\Models\Penelitian;
use App\Models\JenisOutput;
use App\Models\OutputDetail;
use App\Models\StatusOutput;
use Illuminate\Http\Request;
use App\Http\Controllers\OutputController;
use App\Http\Requests\StoreHkiOutputRequest;
use App\Http\Requests\StoreVideoOutputRequest;
use App\Http\Requests\StorePublikasiOutputRequest;
use App\Http\Requests\StoreFotoPosterOutputRequest;

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
        return view('output.tambah.index', [
            'jenis_output' => JenisOutput::with('jenisOutputKey')->get(),
            'status_output' => StatusOutput::all(),
            'tipe' => OutputType::getValues(),
            'users' => User::select('id', 'name')->get(),
        ]);
    }

    public function createFromPenelitian($uuid)
    {
        return view('output.tambah.index', [
            'jenis_output' => JenisOutput::with('jenisOutputKey')->get(),
            'status_output' => StatusOutput::all(),
            'tipe' => OutputType::getValues(),
            'users' => User::select('id', 'name')->get(),
            'penelitian' => Penelitian::with('users')
                ->where('uuid', $uuid)
                ->firstOrFail(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function storePublikasi(StorePublikasiOutputRequest $request)
    {
        $uuid = $request->uuid;

        $uuid
            ? ($penelitian = Penelitian::with('output.outputDetails')
                ->where('uuid', $uuid)
                ->first())
            : ($penelitian = Penelitian::create([
                'judul' => $request->judul_penelitian,
                'status_penelitian_id' => 1,
                'jenis_penelitian_id' => 1,
                'skema_id' => 1,
            ]));

        $pivotData = [];
        foreach ($request->user_id as $userId) {
            $pivotData[$userId] = [
                'is_corresponding' =>
                    $userId == $request->is_corresponding ? true : false,
            ];
        }

        $penelitian->users()->sync($pivotData);

        $output = OutputController::store($penelitian->id);

        OutputDetail::create([
            'output_id' => $output->id,
            'jenis_output_id' => $request->jenis_output_id,
            'status_output_id' => $request->status_output_id,
            'tipe' => $request->tipe,
            'judul' => $request->judul_output,
            'tautan' => $request->tautan,
            'published_at' => $request->published_at,
        ]);

        return redirect()
            ->route('laporan-output.index')
            ->with('success', 'Output publikasi berhasil disimpan!');
    }

    public function storeHKI(StoreHkiOutputRequest $request)
    {
        $uuid = $request->uuid;

        $uuid
            ? ($penelitian = Penelitian::with('output.outputDetails')
                ->where('uuid', $uuid)
                ->first())
            : ($penelitian = Penelitian::create([
                'judul' => $request->judul_penelitian,
                'status_penelitian_id' => 1,
                'jenis_penelitian_id' => 1,
                'skema_id' => 1,
            ]));

        $pivotData = [];
        foreach ($request->user_id as $userId) {
            $pivotData[$userId] = [
                'is_corresponding' =>
                    $userId == $request->is_corresponding ? true : false,
            ];
        }

        $penelitian->users()->sync($pivotData);

        $output = OutputController::store($penelitian->id);

        OutputDetail::create([
            'output_id' => $output->id,
            'jenis_output_id' => $request->jenis_output_id,
            'status_output_id' => $request->status_output_id,
            'judul' => $request->judul_output,
            'tautan' => $request->tautan,
            'published_at' => $request->published_at,
        ]);

        return redirect()
            ->route('laporan-output.index')
            ->with('success', 'Output publikasi berhasil disimpan!');
    }

    public function storeFotoPoster(StoreFotoPosterOutputRequest $request)
    {
        $uuid = $request->uuid;

        $uuid
            ? ($penelitian = Penelitian::with('output.outputDetails')
                ->where('uuid', $uuid)
                ->first())
            : ($penelitian = Penelitian::create([
                'judul' => $request->judul_output,
                'status_penelitian_id' => 1,
                'jenis_penelitian_id' => 1,
                'skema_id' => 1,
            ]));

        $userId = auth()->user()->id;

        $pivotData = [];
        foreach ($request->user_id as $userId) {
            $pivotData[$userId] = [
                'is_corresponding' =>
                    $userId == $request->is_corresponding ? true : false,
            ];
        }

        $penelitian->users()->sync($pivotData);

        $output = OutputController::store($penelitian->id);

        OutputDetail::create([
            'output_id' => $output->id,
            'jenis_output_id' => $request->jenis_output_id,
            'status_output_id' => 1,
            'judul' => $request->judul_output,
            'file' => $request->hasFile('file')
                ? $request->file('file')->store('output-foto-poster', 'public')
                : null,
        ]);

        return redirect()
            ->route('laporan-output.index')
            ->with('success', 'Output publikasi berhasil disimpan!');
    }

    public function storeVideo(StoreVideoOutputRequest $request)
    {
        $uuid = $request->uuid;

        $uuid
            ? ($penelitian = Penelitian::with('output.outputDetails')
                ->where('uuid', $uuid)
                ->first())
            : ($penelitian = Penelitian::create([
                'judul' => $request->judul_output,
                'status_penelitian_id' => 1,
                'jenis_penelitian_id' => 1,
                'skema_id' => 1,
            ]));

        $userId = auth()->user()->id;

        $pivotData = [];
        foreach ($request->user_id as $userId) {
            $pivotData[$userId] = [
                'is_corresponding' =>
                    $userId == $request->is_corresponding ? true : false,
            ];
        }

        $penelitian->users()->sync($pivotData);

        $output = OutputController::store($penelitian->id);

        OutputDetail::create([
            'output_id' => $output->id,
            'jenis_output_id' => $request->jenis_output_id,
            'status_output_id' => 1,
            'judul' => $request->judul_output,
            'tautan' => $request->tautan,
        ]);

        return redirect()
            ->route('laporan-output.index')
            ->with('success', 'Output publikasi berhasil disimpan!');
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
