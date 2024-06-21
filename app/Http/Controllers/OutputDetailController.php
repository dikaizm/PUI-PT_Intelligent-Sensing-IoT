<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\OutputType;
use App\Models\Penelitian;
use App\Models\JenisOutput;
use App\Models\OutputDetail;
use App\Models\StatusOutput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\OutputController;
use App\Http\Requests\StoreHkiOutputRequest;
use App\Http\Requests\UpdateHkiOutputRequest;
use App\Http\Requests\StoreVideoOutputRequest;
use App\Http\Requests\UpdateVideoOutputRequest;
use App\Http\Requests\StorePublikasiOutputRequest;
use App\Http\Requests\StoreFotoPosterOutputRequest;
use App\Http\Requests\UpdatePublikasiOutputRequest;
use App\Http\Requests\UpdateFotoPosterOutputRequest;

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
            'jenis_output' => JenisOutput::with([
                'jenisOutputKey' => function ($query) {
                    $query->orderBy('name', 'asc');
                },
            ])->get(),
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
        $output_key = JenisOutput::with('jenisOutputKey')
            ->where('id', $request->jenis_output_id)
            ->first();

        $jenis_output_key_name = $output_key->jenisOutputKey->name;

        if ($jenis_output_key_name !== 'Publikasi') {
            return redirect()
                ->back()
                ->with(
                    'danger',
                    'Formulir tidak sesuai, jenis output: ' .
                        $jenis_output_key_name .
                        ',formulir: Publikasi'
                );
        }

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
                'output_only' => true,
            ]));

        $userData = [];
        // Loop through all inputs that start with 'user_id_'
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'user_id_publikasi_') === 0) {
                $userId = substr($key, strlen('user_id_publikasi_')); // Extract numeric part
                $userData[$userId] = $value; // Store value in array
            }
        }

        $pivotData = [];
        foreach ($userData as $userId) {
            if (is_numeric($userId) && $userId != '' && User::find($userId)) {
                $pivotData[$userId] = [
                    'is_corresponding' =>
                    $userId == $request->is_corresponding ? true : false,
                ];
            };
        }

        // Sync the pivot table data
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
        $output_key = JenisOutput::with('jenisOutputKey')
            ->where('id', $request->jenis_output_id)
            ->first();

        $jenis_output_key_name = $output_key->jenisOutputKey->name;

        if ($jenis_output_key_name !== 'HKI') {
            return redirect()
                ->back()
                ->with(
                    'danger',
                    'Formulir tidak sesuai, jenis output: ' .
                        $jenis_output_key_name .
                        ',formulir: HKI'
                );
        }

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
                'output_only' => true,
            ]));

        $userData = [];
        // Loop through all inputs that start with 'user_id_'
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'user_id_hki_') === 0) {
                $userId = substr($key, strlen('user_id_hki_')); // Extract numeric part
                $userData[$userId] = $value; // Store value in array
            }
        }

        $pivotData = [];
        foreach ($userData as $userId) {
            if (is_numeric($userId) && $userId != '' && User::find($userId)) {
                $pivotData[$userId] = [
                    'is_corresponding' =>
                    $userId == $request->is_corresponding ? true : false,
                ];
            };
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
        $output_key = JenisOutput::with('jenisOutputKey')
            ->where('id', $request->jenis_output_id)
            ->first();

        $jenis_output_key_name = $output_key->jenisOutputKey->name;

        if ($jenis_output_key_name !== 'Foto/Poster') {
            return redirect()
                ->back()
                ->with(
                    'danger',
                    'Formulir tidak sesuai, jenis output: ' .
                        $jenis_output_key_name .
                        ',formulir: Foto/Poster'
                );
        }

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
                'output_only' => true,
            ]));

        $userData = [];
        // Loop through all inputs that start with 'user_id_'
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'user_id_foto_') === 0) {
                $userId = substr($key, strlen('user_id_foto_')); // Extract numeric part
                $userData[$userId] = $value; // Store value in array
            }
        }

        $pivotData = [];
        foreach ($userData as $userId) {
            if (is_numeric($userId) && $userId != '' && User::find($userId)) {
                $pivotData[$userId] = [
                    'is_corresponding' =>
                    $userId == $request->is_corresponding ? true : false,
                ];
            };
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
        $output_key = JenisOutput::with('jenisOutputKey')
            ->where('id', $request->jenis_output_id)
            ->first();

        $jenis_output_key_name = $output_key->jenisOutputKey->name;

        if ($jenis_output_key_name !== 'Video') {
            return redirect()
                ->back()
                ->with(
                    'danger',
                    'Formulir tidak sesuai, jenis output: ' .
                        $jenis_output_key_name .
                        ',formulir: Video'
                );
        }

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
                'output_only' => true,
            ]));

        $userData = [];
        // Loop through all inputs that start with 'user_id_'
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'user_id_video_') === 0) {
                $userId = substr($key, strlen('user_id_video_')); // Extract numeric part
                $userData[$userId] = $value; // Store value in array
            }
        }

        $pivotData = [];
        foreach ($userData as $userId) {
            if (is_numeric($userId) && $userId != '' && User::find($userId)) {
                $pivotData[$userId] = [
                    'is_corresponding' =>
                    $userId == $request->is_corresponding ? true : false,
                ];
            };
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
    public function update(Request $request, string $id)
    {
        //
    }

    public function updatePublikasi(
        UpdatePublikasiOutputRequest $request,
        string $id
    ) {
        $publikasi = OutputDetail::findOrFail($id);

        $publikasi->jenis_output_id = $publikasi->jenis_output_id;
        $publikasi->tipe = $request->tipe;
        $publikasi->judul = $request->judul_output;
        $publikasi->status_output_id = $request->status_output_id;
        $publikasi->published_at = $request->published_at;
        $publikasi->tautan = $request->tautan;

        $publikasi->save();

        return redirect()
            ->back()
            ->with('success', 'Publikasi berhasil diperbarui');
    }

    public function updateHKI(UpdateHkiOutputRequest $request, string $id)
    {
        $hki = OutputDetail::findOrFail($id);

        $hki->jenis_output_id = $hki->jenis_output_id;
        $hki->judul = $request->judul_output;
        $hki->status_output_id = $request->status_output_id;
        $hki->published_at = $request->published_at;
        $hki->tautan = $request->tautan;

        $hki->save();

        return redirect()
            ->back()
            ->with('success', 'Output Publikasi anda berhasil diperbarui');
    }

    public function updateFotoPoster(
        UpdateFotoPosterOutputRequest $request,
        string $id
    ) {
        $fotoposter = OutputDetail::findOrFail($id);

        $fotoposter->jenis_output_id = $fotoposter->jenis_output_id;
        $fotoposter->judul = $request->judul_output;

        // if ($request->hasFile('file') && $fotoposter->file) {
        //     Storage::disk('public')->delete($fotoposter->file);
        // }

        // $fotoposter->file = $request->hasFile('file')
        //     ? $request->file('file')->store('output-foto-poster', 'public')
        //     : $fotoposter->file;

        $fotoposter->save();

        return redirect()
            ->back()
            ->with('success', 'Output Foto poster anda berhasil diperbarui');
    }

    public function updateVideo(UpdateVideoOutputRequest $request, string $id)
    {
        $video = OutputDetail::findOrFail($id);

        $video->jenis_output_id = $video->jenis_output_id;
        $video->judul = $request->judul_output;
        $video->tautan = $request->tautan;

        $video->save();

        return redirect()
            ->back()
            ->with('success', 'Output video anda berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $output_detail = OutputDetail::findOrFail($id);

        if ($output_detail->file) {
            $filePath = storage_path('app/public/' . $output_detail->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $output_detail->delete();

        return redirect()->back()->with('success', 'Output berhasil dihapus!');
    }
}
