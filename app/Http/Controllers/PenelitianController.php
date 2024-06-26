<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skema;
use App\Models\Penelitian;
use Illuminate\Http\Request;
use App\Models\JenisPenelitian;
use App\Models\StatusPenelitian;
use App\Models\JenisOutput;
use App\Models\JenisOutputKey;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePenelitianRequest;
use App\Http\Requests\UpdatePenelitianRequest;
use App\Models\AuthorOutput;
use App\Models\OutputDetail;

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
        $arsip = $arsip == 'true';

        $user = auth()->user();
        $isAdminOrKaur = $user->hasRole('Admin') || $user->hasRole('Kaur');

        $outputIds = [];
        $penelitianIds = [];

        if ($arsip) {
            // Get output ids based on arsip status
            $outputIds = OutputDetail::where('arsip', $arsip)->pluck('output_id')->toArray();

            // Get penelitian id based on output and arsip status
            $penelitianIds = Penelitian::whereIn('id', $outputIds)->pluck('id')->toArray();
        } else {
            // If arsip is false, get penelitian where output_only is false
            $penelitianIds = Penelitian::where('output_only', false)->pluck('id')->toArray();
        }

        // If user is an admin or Kaur, adjust penelitianIds
        if ($isAdminOrKaur) {
            $penelitianIds2 = Penelitian::where('arsip', $arsip)->pluck('id')->toArray();
        } else {
            $penelitianIds2 = $user->penelitians()->where('arsip', $arsip)->pluck('penelitian.id')->toArray();
        }

        if ($arsip) {
            $penelitianIds = array_merge($penelitianIds, $penelitianIds2);
        } else {
            $penelitianIds = array_intersect($penelitianIds, $penelitianIds2);
        }

        // dd($penelitianIds);

        if ($isAdminOrKaur) {
            $penelitian = Penelitian::whereIn('id', $penelitianIds)
                ->with([
                    'statusPenelitian',
                    'statusPenelitian.statusPenelitianKey',
                ])->get();
        } else {
            $penelitian = $user->penelitians()
                ->whereIn('penelitian.id', $penelitianIds)
                ->with([
                    'statusPenelitian',
                    'statusPenelitian.statusPenelitianKey',
                ])->get();
        }

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
    public function show(Request $request, $uuid)
    {
        $arsip = $request->query('arsip', 'false') == 'true';

        $penelitian = Penelitian::where('uuid', $uuid)->first();

        if (!$penelitian) {
            abort(404);
        }

        $output = $penelitian->output()->first();

        // Check if penelitian and penelitian's output exist
        if ($penelitian && $penelitian->output) {
            $output = OutputDetail::where('output_id', $output->id)
                ->where('arsip', $arsip)
                ->get();
        } else {
            $output = null;
        }

        // $anggotaTim = $penelitian->users->pluck('id')->toArray();

        $ketuaTim = $penelitian->users->where('pivot.is_ketua', true)->first();
        $is_ketua = $ketuaTim ? $ketuaTim->id : null;

        if ($arsip) {
            if (!$penelitian->arsip) {
                $penelitian = null;
            }
        }

        return view('penelitian.modal-detail', [
            'penelitian' => $penelitian,
            'output' => $output,
            'jenis_output' => JenisOutput::all(),
            'jenis_output_key' => JenisOutputKey::all(),
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
        foreach ($userData as $userId) {
            $pivotData[$userId] = [
                'is_ketua' => $userId == $request->is_ketua ? true : false,
            ];
        }

        // Get current user IDs attached to the penelitian
        $currentUserIds = $penelitian->users()->pluck('user_id')->toArray();

        // Detach users that are not in the new list
        foreach ($currentUserIds as $currentUserId) {
            if (!in_array($currentUserId, $userData)) {
                $penelitian->users()->detach($currentUserId);
            }
        }

        // Attach or update users
        foreach ($userData as $userId) {
            if ($userId !== null && isset($pivotData[$userId])) {
                // Check if the user is already attached
                if (!$penelitian->users()->where('user_id', $userId)->exists()) {
                    $penelitian->users()->attach($userId, $pivotData[$userId]);
                } else {
                    // Update the existing pivot data
                    $penelitian->users()->updateExistingPivot($userId, $pivotData[$userId]);
                }
            }
        }

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

        // Delete all of relations
        $output = $penelitian->output()->first();

        if ($output) {
            AuthorOutput::whereIn('output_detail_id', $output->outputDetails->pluck('id'))->delete();
            $output->outputDetails()->delete();
            $output->delete();
        }

        $penelitian->users()->detach();
        $penelitian->delete();

        return redirect()
            ->route('penelitian.index')
            ->with('success', 'Penelitian berhasil dihapus!');
    }


    public function archive($uuid)
    {
        $penelitian = Penelitian::where('uuid', $uuid)->firstOrFail();
        $penelitian->update(['arsip' => true]);
        return redirect()
            ->route('penelitian.index')
            ->with('success', 'Penelitian berhasil diarsipkan!');
    }

    public function unarchive($uuid)
    {
        $penelitian = Penelitian::where('uuid', $uuid)->firstOrFail();
        $penelitian->update(['arsip' => false]);
        return redirect()
            ->route('penelitian.index', ['arsip' => 'true'])
            ->with('success', 'Penelitian berhasil di-unarchive!');
    }
}
