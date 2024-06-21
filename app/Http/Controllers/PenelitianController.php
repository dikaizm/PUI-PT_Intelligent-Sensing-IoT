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

        $user = auth()->user();
        $isAdminOrKaur = $user->hasRole('Admin') || $user->hasRole('Kaur');

        $penelitian = $isAdminOrKaur
            ? Penelitian::where('arsip', $arsip === 'true')
            ->where('output_only', false)
            ->with([
                'statusPenelitian',
                'statusPenelitian.statusPenelitianKey',
            ])->get()
            : auth()
            ->user()
            ->penelitians()
            ->where('arsip', $arsip === 'true')
            ->where('output_only', false)
            ->with([
                'statusPenelitian',
                'statusPenelitian.statusPenelitianKey',
            ])->get();

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
        // print
        // dd($request->all());

        $isArsip = $request->boolean('arsip', false);
        $skema_other = $request->skema_lainnya;
        $jenisPenelitian_other = $request->jenisPenelitian_lainnya;

        if ($skema_other) {
            $skema = Skema::create(['name' => $skema_other]);
            $request->merge(['skema_id' => $skema->id]);
        }

        if ($jenisPenelitian_other) {
            $jenisPenelitian = JenisPenelitian::create([
                'name' => $jenisPenelitian_other,
            ]);
            $request->merge(['jenis_penelitian_id' => $jenisPenelitian->id]);
        }

        $penelitian = Penelitian::create([
            'judul' => $request->judul,
            'tingkatan_tkt' => $request->tingkatan_tkt,
            'pendanaan' => $request->pendanaan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_akhir' => $request->waktu_akhir,
            'jangka_waktu' => $request->jangka_waktu,
            // 'file' => $request->hasFile('file')
            //     ? $request->file('file')->store('penelitian', 'public')
            //     : null,
            'link_penelitian' => $request->link_penelitian,
            'feedback' => $request->feedback,
            'mitra' => $request->mitra,
            'status_penelitian_id' => $request->status_penelitian_id,
            'jenis_penelitian_id' => $request->jenis_penelitian_id,
            'skema_id' => $request->skema_id,
            'arsip' => $isArsip,
            'output_only' => false,
        ]);

        $userData = [];
        // Loop through all inputs that start with 'user_id_'
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'user_id_') === 0) {
                $userId = substr($key, strlen('user_id_')); // Extract numeric part
                $userData[$userId] = $value; // Store value in array
            }
        }

        $pivotData = [];
        foreach ($userData as $userId) {
            $pivotData[$userId] = [
                'is_ketua' => $userId == $request->is_ketua ? true : false,
            ];
        }

        foreach ($userData as $userId) {
            if ($userId !== null && isset($pivotData[$userId])) {
                $penelitian->users()->attach($userId, $pivotData[$userId]);
            }
        }

        OutputController::store($penelitian->id);

        $msg = $isArsip
            ? 'Penelitian berhasil ditambahkan dan diarsipkan!'
            : 'Penelitian berhasil ditambahkan!';

        return redirect()
            ->route('penelitian.index')
            ->with('success', $msg);
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
        $users = User::select('id', 'name')->whereIn('id', $anggotaTim)->get();

        // Temukan model User berdasarkan ID ketua
        $userKetua = User::find($is_ketua);

        return view('penelitian.edit-data-penelitian', [
            'penelitian' => $penelitian,
            'skema' => Skema::select('id', 'name')->get(),
            'jenis_penelitian' => JenisPenelitian::select('id', 'name')->get(),
            'waktu_mulai' => $penelitian->waktu_mulai,
            'waktu_akhir' => $penelitian->waktu_akhir
                ? $penelitian->waktu_akhir
                : null,
            'jangka_waktu' => $penelitian->jangka_waktu,
            'status_penelitian' => StatusPenelitian::with(
                'statusPenelitianKey'
            )->get(),
            'link_penelitian' => $penelitian->link_penelitian,
            'users' => $users,
            'anggotaTim' => $anggotaTim,
            'is_ketua' => $is_ketua,
            'userKetua' => $userKetua, // Kirim model User ketua ke view
        ]);
    }

    public function update(UpdatePenelitianRequest $request, $uuid)
    {
        $penelitian = Penelitian::where('uuid', $uuid)->firstOrFail();

        // Update penelitian
        $penelitian->update([
            'judul' => $request->judul,
            'tingkatan_tkt' => $request->tingkatan_tkt,
            'pendanaan' => $request->pendanaan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_akhir' => $request->waktu_akhir,
            'jangka_waktu' => $request->jangka_waktu,
            'link_penelitian' => $request->link_penelitian,
            'mitra' => $request->mitra,
            'status_penelitian_id' => $request->status_penelitian_id,
            'jenis_penelitian_id' => $request->jenis_penelitian_id,
            'skema_id' => $request->skema_id,
            'arsip' => $request->boolean('arsip'),
        ]);

        $userData = [];
        // Loop through all inputs that start with 'user_id_'
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'user_id_') === 0) {
                $userId = substr($key, strlen('user_id_')); // Extract numeric part
                $userData[$userId] = $value; // Store value in array
            }
        }

        $pivotData = [];
        foreach ($userData as $userId => $value) {
            if (is_numeric($userId) && $userId != '' && User::find($userId)) {
                $pivotData[$userId] = [
                    'is_ketua' => $userId == $request->is_ketua ? true : false,
                ];
            }
        }

        // Sync the pivot table data
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
        $penelitian->output()->delete();
        $penelitian->delete();

        return redirect()
            ->route('penelitian.index')
            ->with('success', 'Penelitian berhasil dihapus!');
    }
}
