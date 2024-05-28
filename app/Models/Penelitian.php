<?php

namespace App\Models;

use App\Models\User;
use App\Models\Skema;
use App\Models\Output;
use App\Models\JenisPenelitian;
use App\Models\StatusPenelitian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Penelitian extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'penelitian';

    protected $attributes = [
        'arsip' => false,
    ];

    protected $fillable = [
        'judul',
        'tingkatan_tkt',
        'pendanaan',
        'jangka_waktu',
        'file',
        'feedback',
        'status_penelitian_id',
        'jenis_penelitian_id',
        'skema_id',
        'arsip',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'author',
            'penelitian_id',
            'user_id'
        )->withPivot('is_corresponding', 'is_ketua');
    }

    public function output(): HasOne
    {
        return $this->hasOne(Output::class);
    }

    public function statusPenelitian(): BelongsTo
    {
        return $this->belongsTo(StatusPenelitian::class);
    }

    public function jenisPenelitian(): BelongsTo
    {
        return $this->belongsTo(JenisPenelitian::class);
    }

    public function skema(): BelongsTo
    {
        return $this->belongsTo(Skema::class);
    }

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }
}
