<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skema;
use App\Models\Penelitian;
use Illuminate\Http\Request;
use App\Models\JenisPenelitian;
use App\Models\StatusPenelitian;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePenelitianRequest;
use App\Http\Requests\UpdatePenelitianRequest;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $arsip = $request->query('arsip', 'false');
        if (!in_array($arsip, ['true', 'false'])) {
            abort(
                400,
                'Invalid value for arsip parameter. It should be either true or false.'
            );
        }

        $penelitian = auth()->user()->hasRole('Admin')
            ? Penelitian::where('arsip', $arsip === 'true')
                ->with([
                    'statusPenelitian',
                    'statusPenelitian.statusPenelitianKey',
                ])
                ->get()
            : auth()
                ->user()
                ->penelitians()
                ->where('arsip', $arsip === 'true')
                ->with([
                    'statusPenelitian',
                    'statusPenelitian.statusPenelitianKey',
                ])
                ->get();

        return view('penelitian.index', [
            'penelitian' => $penelitian,
            'status_penelitian' => StatusPenelitian::all(),
            'jenis_penelitian' => JenisPenelitian::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penelitian.tambah-data-penelitian', [
            'skema' => Skema::select('id', 'name')->get(),
            'jenis_penelitian' => JenisPenelitian::select('id', 'name')->get(),
            'status_penelitian' => StatusPenelitian::with(
                'statusPenelitianKey'
            )->get(),
            'users' => User::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenelitianRequest $request)
    {
        $penelitian = Penelitian::create([
            'judul' => $request->judul,
            'tingkatan_tkt' => $request->tingkatan_tkt,
            'pendanaan' => $request->pendanaan,
            'jangka_waktu' => $request->jangka_waktu,
            'file' => $request->hasFile('file')
                ? $request->file('file')->store('penelitian', 'public')
                : null,
            'feedback' => $request->feedback,
            'mitra' => $request->mitra,
            'status_penelitian_id' => $request->status_penelitian_id,
            'jenis_penelitian_id' => $request->jenis_penelitian_id,
            'skema_id' => $request->skema_id,
            'arsip' => $request->boolean('arsip', false),
        ]);

        $pivotData = [];
        foreach ($request->user_id as $userId) {
            $pivotData[$userId] = [
                'is_ketua' => $userId == $request->is_ketua ? true : false,
            ];
        }

        $penelitian->users()->sync($pivotData);

        OutputController::store($penelitian->id);

        return redirect()
            ->route('penelitian.index')
            ->with('success', 'Penelitian berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $penelitian = Penelitian::where('uuid', $uuid)->first();
        $output = $penelitian->output
            ? $penelitian->output->outputDetails
            : null;
        $anggotaTim = $penelitian->users->pluck('id')->toArray();
        $ketuaTim = $penelitian->users->where('pivot.is_ketua', true)->first();
        $is_ketua = $ketuaTim ? $ketuaTim->id : null;

        return view('penelitian.modal-detail', [
            'penelitian' => $penelitian,
            'output' => $output,
            'is_ketua' => $is_ketua, // Kirimkan $is_ketua ke dalam view
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $penelitian = Penelitian::where('uuid', $uuid)
            ->with([
                'skema',
                'jenisPenelitian',
                'statusPenelitian.statusPenelitianKey',
                'users',
            ])
            ->firstOrFail();

        // Ambil daftar anggota tim dan siapa ketua timnya
        $anggotaTim = $penelitian->users->pluck('id')->toArray();
        $ketuaTim = $penelitian->users->where('pivot.is_ketua', true)->first();
        $is_ketua = $ketuaTim ? $ketuaTim->id : null;

        // Temukan model User berdasarkan ID ketua
        $userKetua = User::find($is_ketua);

        return view('penelitian.edit-data-penelitian', [
            'penelitian' => $penelitian,
            'skema' => Skema::select('id', 'name')->get(),
            'jenis_penelitian' => JenisPenelitian::select('id', 'name')->get(),
            'status_penelitian' => StatusPenelitian::with(
                'statusPenelitianKey'
            )->get(),
            'users' => User::select('id', 'name')->get(),
            'anggotaTim' => $anggotaTim,
            'is_ketua' => $is_ketua,
            'userKetua' => $userKetua, // Kirim model User ketua ke view
        ]);
    }

    public function update(UpdatePenelitianRequest $request, $uuid)
    {
        $penelitian = Penelitian::where('uuid', $uuid)->firstOrFail();

        if ($request->hasFile('file') && $penelitian->file) {
            Storage::disk('public')->delete($penelitian->file);
        }

        // Update penelitian
        $penelitian->update([
            'judul' => $request->judul,
            'tingkatan_tkt' => $request->tingkatan_tkt,
            'pendanaan' => $request->pendanaan,
            'jangka_waktu' => $request->jangka_waktu,
            'file' => $request->hasFile('file')
                ? $request->file('file')->store('penelitian', 'public')
                : $penelitian->file,
            'mitra' => $request->mitra,
            'status_penelitian_id' => $request->status_penelitian_id,
            'jenis_penelitian_id' => $request->jenis_penelitian_id,
            'skema_id' => $request->skema_id,
            'arsip' => $request->boolean('arsip'),
        ]);

        $pivotData = [];
        foreach ($request->user_id as $userId) {
            $pivotData[$userId] = [
                'is_ketua' => $userId == $request->is_ketua ? true : false,
            ];
        }

        $penelitian->users()->sync($pivotData);

        return redirect()
            ->route('penelitian.index')
            ->with('success', 'Penelitian berhasil diperbarui!');
    }

    public function updateStatusPenelitian(Request $request, $uuid)
    {
        $request->validate([
            'status_penelitian_id' => ['required'],
        ]);
        Penelitian::where('uuid', $uuid)->update([
            'status_penelitian_id' => $request->status_penelitian_id,
        ]);
        return redirect()
            ->back()
            ->with('success', 'Status Penelitian berhasil diperbarui!');
    }

    public function updateFeedback(Request $request, $uuid)
    {
        $request->validate([
            'feedback' => ['string', 'max:1000'],
        ]);
        Penelitian::where('uuid', $uuid)->update([
            'feedback' => $request->feedback,
        ]);
        return redirect()
            ->back()
            ->with('success', 'Feedback berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $penelitian = Penelitian::where('uuid', $uuid)->firstOrFail();

        if ($penelitian->file) {
            $filePath = storage_path('app/public/' . $penelitian->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $penelitian->users()->detach();
        $penelitian->delete();

        return redirect()
            ->route('penelitian.index')
            ->with('success', 'Penelitian berhasil dihapus!');
    }
}
