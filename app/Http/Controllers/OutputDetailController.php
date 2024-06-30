<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\OutputType;
use App\Models\Penelitian;
use App\Models\JenisOutput;
use App\Models\OutputDetail;
use App\Models\StatusOutput;
use App\Models\Author;
use App\Models\AuthorOutput;
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
    private function attachUsersToPenelitian($request, $penelitian)
    {
        $userData = [];

        // Loop through all inputs that start with 'user_id_'
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'user_id_') === 0) {
                $userId = substr($key, strlen('user_id_')); // Extract numeric part
                $userData[$userId] = $value; // Store value in array
            }
        }

        // dd($userData);

        foreach ($userData as $userId => $value) {
            // Attach user to penelitian if not already attached
            if (!$penelitian->users()->where('user_id', $value)->exists()) {
                $penelitian->users()->attach($value);
            }
        }

        return $userData;
    }

    private function processAuthorOutputs($penelitian, $outputDetail, $request, $userData)
    {
        // Get authors with user_id from penelitian
        $authors = Author::whereIn('user_id', $userData)
            ->where('penelitian_id', $penelitian->id)
            ->get();

        // Create pivot data for authorOutputs corresponding
        $pivotDataAuthor = [];
        foreach ($authors as $author) {
            $pivotDataAuthor[$author->id] = [
                'is_corresponding' => $author->user_id == $request->is_corresponding ? true : false,
            ];
        }

        // Create authorOutputs for each author
        foreach ($authors as $author) {
            $outputDetail->authorOutputs()->insert([
                'author_id' => $author->id,
                'output_detail_id' => $outputDetail->id,
                'is_corresponding' => $pivotDataAuthor[$author->id]['is_corresponding'],
            ]);
        }
    }


    private function processAuthorOutputsUpdate($request, $outputDetail, $useCorresponding = false)
    {
        $penelitian = $outputDetail->output->penelitian;

        // Extract user IDs from the request
        $userData = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'user_id_') === 0) {
                $userId = substr($key, strlen('user_id_')); // Extract numeric part
                $userData[$userId] = $value; // Store value in array
            }
        }

        // Get current user IDs attached to the penelitian
        $currentUserIds = $penelitian->users()->pluck('user_id')->toArray();

        // Attach users to penelitian if not already attached
        foreach ($userData as $userId) {
            if (!in_array($userId, $currentUserIds)) {
                $penelitian->users()->attach($userId);
            }
        }

        // Get authors with user_id from penelitian
        $authors = Author::whereIn('user_id', $userData)
            ->where('penelitian_id', $penelitian->id)
            ->get();

        // Create or update authorOutputs for each author
        foreach ($authors as $author) {
            if ($useCorresponding) {
                $isCorresponding = $author->user_id == $request->is_corresponding;
            } else {
                $isCorresponding = false;
            }

            $outputDetail->authorOutputs()->updateOrCreate(
                ['author_id' => $author->id],
                ['is_corresponding' => $isCorresponding]
            );
        }

        // Delete authors not associated with any authorOutputs
        $outputDetailIds = OutputDetail::where('output_id', $outputDetail->output_id)
            ->pluck('id')
            ->toArray();

        $authorOutputs = AuthorOutput::whereIn('output_detail_id', $outputDetailIds)
            ->pluck('author_id')
            ->toArray();

        Author::where('penelitian_id', $penelitian->id)
            ->whereNotIn('id', $authorOutputs)
            ->delete();
    }


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


        $userData = $this->attachUsersToPenelitian($request, $penelitian);

        $output = OutputController::store($penelitian->id);

        $outputDetail = OutputDetail::create([
            'output_id' => $output->id,
            'jenis_output_id' => $request->jenis_output_id,
            'status_output_id' => $request->status_output_id,
            'tipe' => $request->tipe,
            'judul' => $request->judul_output,
            'tautan' => $request->tautan,
            'published_at' => $request->published_at,
        ]);

        $this->processAuthorOutputs($penelitian, $outputDetail, $request, $userData);

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

        $userData = $this->attachUsersToPenelitian($request, $penelitian);

        $output = OutputController::store($penelitian->id);

        $outputDetail = OutputDetail::create([
            'output_id' => $output->id,
            'jenis_output_id' => $request->jenis_output_id,
            'status_output_id' => $request->status_output_id,
            'judul' => $request->judul_output,
            'tautan' => $request->tautan,
            'published_at' => $request->published_at,
        ]);

        $this->processAuthorOutputs($penelitian, $outputDetail, $request, $userData);

        return redirect()
            ->route('laporan-output.index')
            ->with('success', 'Output HKI berhasil disimpan!');
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

        $userData = $this->attachUsersToPenelitian($request, $penelitian);

        $output = OutputController::store($penelitian->id);

        $outputDetail = OutputDetail::create([
            'output_id' => $output->id,
            'jenis_output_id' => $request->jenis_output_id,
            'status_output_id' => $request->status_output_id,
            'judul' => $request->judul_output,
            'tautan' => $request->tautan,
        ]);

        $this->processAuthorOutputs($penelitian, $outputDetail, $request, $userData);

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

        $userData = $this->attachUsersToPenelitian($request, $penelitian);

        $output = OutputController::store($penelitian->id);

        $outputDetail = OutputDetail::create([
            'output_id' => $output->id,
            'jenis_output_id' => $request->jenis_output_id,
            'status_output_id' => $request->status_output_id,
            'judul' => $request->judul_output,
            'tautan' => $request->tautan,
        ]);

        $this->processAuthorOutputs($penelitian, $outputDetail, $request, $userData);

        return redirect()
            ->route('laporan-output.index')
            ->with('success', 'Output video berhasil disimpan!');
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
    public function edit(string $id, string $output_type)
    {
        if ($output_type === 'publikasi') {
            return $this->editPublikasi($id);
        } else if ($output_type === 'hki') {
            return $this->editHKI($id);
        } else if ($output_type === 'foto-poster') {
            return $this->editFotoPoster($id);
        } else if ($output_type === 'video') {
            return $this->editVideo($id);
        }
    }

    private function editPublikasi(string $id)
    {
        $outputDetail = OutputDetail::findOrFail($id);
        // Check if found
        if (!$outputDetail) {
            return redirect()
                ->back()
                ->with('danger', 'Output tidak ditemukan');
        }

        // Check if the output is of type 'Publikasi'
        if ($outputDetail->jenisOutput->jenisOutputKey->name !== 'Publikasi') {
            return redirect()
                ->back()
                ->with('danger', 'Output bukan merupakan publikasi');
        }

        $penelitian = $outputDetail->output->penelitian;
        $authorOutputs = $outputDetail->authorOutputs;

        // Get the IDs of the authors in authorOutputs
        $authorOutputUserIds = $authorOutputs->pluck('author_id')->toArray();

        // Get the users of penelitian who are also in authorOutputs
        $authors = $penelitian->users()->whereIn('author.id', $authorOutputUserIds)->get();

        // Get the corresponding author
        $authorCorresponding = $authorOutputs->where('is_corresponding', true)->first();

        $userCorresponding = $authorCorresponding
            ? User::find($authorCorresponding->author->user_id)
            : null;

        return view('output.edit.publikasi', [
            'output' => $outputDetail,
            'jenis_output' => JenisOutput::with([
                'jenisOutputKey' => function ($query) {
                    $query->orderBy('name', 'asc');
                },
            ])->get(),
            'status_output' => StatusOutput::all(),
            'tipe' => OutputType::getValues(),
            'authors' => $authors,
            'userCorresponding' => $userCorresponding,
        ]);
    }

    private function editHKI(string $id)
    {
        $outputDetail = OutputDetail::findOrFail($id);
        // Check if found
        if (!$outputDetail) {
            return redirect()
                ->back()
                ->with('danger', 'Output tidak ditemukan');
        }

        // Check if the output is of type 'HKI'
        if ($outputDetail->jenisOutput->jenisOutputKey->name !== 'HKI') {
            return redirect()
                ->back()
                ->with('danger', 'Output bukan merupakan HKI');
        }

        $penelitian = $outputDetail->output->penelitian;
        $authorOutputs = $outputDetail->authorOutputs;

        // Get the IDs of the authors in authorOutputs
        $authorOutputUserIds = $authorOutputs->pluck('author_id')->toArray();

        // Get the users of penelitian who are also in authorOutputs
        $authors = $penelitian->users()->whereIn('author.id', $authorOutputUserIds)->get();

        return view('output.edit.hki', [
            'output' => $outputDetail,
            'jenis_output' => JenisOutput::with([
                'jenisOutputKey' => function ($query) {
                    $query->orderBy('name', 'asc');
                },
            ])->get(),
            'status_output' => StatusOutput::all(),
            'authors' => $authors,
        ]);
    }

    private function editFotoPoster(string $id)
    {
        $outputDetail = OutputDetail::findOrFail($id);
        // Check if found
        if (!$outputDetail) {
            return redirect()
                ->back()
                ->with('danger', 'Output tidak ditemukan');
        }

        // Check if the output is of type 'Foto/Poster'
        if ($outputDetail->jenisOutput->jenisOutputKey->name !== 'Foto/Poster') {
            return redirect()
                ->back()
                ->with('danger', 'Output bukan merupakan Foto/Poster');
        }

        $penelitian = $outputDetail->output->penelitian;
        $authorOutputs = $outputDetail->authorOutputs;

        // Get the IDs of the authors in authorOutputs
        $authorOutputUserIds = $authorOutputs->pluck('author_id')->toArray();

        // Get the users of penelitian who are also in authorOutputs
        $authors = $penelitian->users()->whereIn('author.id', $authorOutputUserIds)->get();

        return view('output.edit.foto-poster', [
            'output' => $outputDetail,
            'jenis_output' => JenisOutput::with([
                'jenisOutputKey' => function ($query) {
                    $query->orderBy('name', 'asc');
                },
            ])->get(),
            'status_output' => StatusOutput::all(),
            'authors' => $authors,
        ]);
    }

    private function editVideo(string $id)
    {
        $outputDetail = OutputDetail::findOrFail($id);
        // Check if found
        if (!$outputDetail) {
            return redirect()
                ->back()
                ->with('danger', 'Output tidak ditemukan');
        }

        // Check if the output is of type 'Video'
        if ($outputDetail->jenisOutput->jenisOutputKey->name !== 'Video') {
            return redirect()
                ->back()
                ->with('danger', 'Output bukan merupakan Video');
        }

        $penelitian = $outputDetail->output->penelitian;
        $authorOutputs = $outputDetail->authorOutputs;

        // Get the IDs of the authors in authorOutputs
        $authorOutputUserIds = $authorOutputs->pluck('author_id')->toArray();

        // Get the users of penelitian who are also in authorOutputs
        $authors = $penelitian->users()->whereIn('author.id', $authorOutputUserIds)->get();

        return view('output.edit.video', [
            'output' => $outputDetail,
            'jenis_output' => JenisOutput::with([
                'jenisOutputKey' => function ($query) {
                    $query->orderBy('name', 'asc');
                },
            ])->get(),
            'status_output' => StatusOutput::all(),
            'authors' => $authors,
        ]);
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
        $outputDetail = OutputDetail::findOrFail($id);

        $outputDetail->jenis_output_id;
        $outputDetail->tipe = $request->tipe;
        $outputDetail->judul = $request->judul_output;
        $outputDetail->status_output_id = $request->status_output_id;
        $outputDetail->published_at = $request->published_at;
        $outputDetail->tautan = $request->tautan;

        $outputDetail->save();

        $this->processAuthorOutputsUpdate($request, $outputDetail, true);

        return redirect()
            ->route('laporan-output.index')
            ->with('success', 'Publikasi berhasil diperbarui');
    }

    public function updateHKI(UpdateHkiOutputRequest $request, string $id)
    {
        $hki = OutputDetail::findOrFail($id);

        $hki->jenis_output_id;
        $hki->judul = $request->judul_output;
        $hki->status_output_id = $request->status_output_id;
        $hki->published_at = $request->published_at;
        $hki->tautan = $request->tautan;

        $hki->save();

        $this->processAuthorOutputsUpdate($request, $hki);

        return redirect()
            ->route('laporan-output.index')
            ->with('success', 'Output HKI anda berhasil diperbarui');
    }

    public function updateFotoPoster(
        UpdateFotoPosterOutputRequest $request,
        string $id
    ) {
        $fotoposter = OutputDetail::findOrFail($id);

        $fotoposter->jenis_output_id = $request->jenis_output_id;
        $fotoposter->judul = $request->judul_output;
        $fotoposter->status_output_id = $request->status_output_id;
        $fotoposter->tautan = $request->tautan;

        $fotoposter->save();

        $this->processAuthorOutputsUpdate($request, $fotoposter);

        return redirect()
            ->route('laporan-output.index')
            ->with('success', 'Output Foto poster anda berhasil diperbarui');
    }

    public function updateVideo(UpdateVideoOutputRequest $request, string $id)
    {
        $video = OutputDetail::findOrFail($id);

        $video->jenis_output_id = $request->jenis_output_id;
        $video->judul = $request->judul_output;
        $video->status_output_id = $request->status_output_id;
        $video->tautan = $request->tautan;

        $video->save();

        $this->processAuthorOutputsUpdate($request, $video);

        return redirect()
            ->route('laporan-output.index')
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

        $output = $output_detail->output;

        $output_detail->authorOutputs()->delete();
        $output_detail->delete();

        // If the output has no more outputDetails, delete the output and penelitian
        if ($output->outputDetails->count() === 0) {
            $penelitian = $output->penelitian;
            $output->delete();

            if ($penelitian->output_only) {
                $penelitian->authors()->delete();
                $penelitian->delete();

                return redirect()->route('laporan-output.index')->with('success', 'Output berhasil dihapus!');
            }
        }

        return redirect()->back()->with('success', 'Output berhasil dihapus!');
    }

    public function archive(string $id)
    {
        $output_detail = OutputDetail::findOrFail($id);

        $output_detail->arsip = true;
        $output_detail->save();

        return redirect()
            ->back()
            ->with('success', 'Output berhasil diarsipkan!');
    }
}
