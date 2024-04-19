<?php

namespace App\Models;

use App\Models\User;
use App\Models\Mitra;
use Ramsey\Uuid\Uuid;
use App\Models\Publikasi;
use App\Models\JenisOutput;
use App\Models\StatusLaporan;
use App\Models\JenisPenelitian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JurnalArticle extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'jurnal_article';

    protected $attributes = [
        'arsip' => false,
    ];

    protected $fillable = [
        'judul',
        'tingkatan_tkt',
        'pendanaan',
        'jangka_waktu',
        'poster',
        'prototype',
        'link_video',
        'file_proposal',
        'feedback',
        'status_laporan_id',
        'jenis_penelitian_id',
        'mitra_id',
        'jenis_output_id',
        'arsip',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'author',
            'jurnal_article_id',
            'user_id'
        )
            ->withPivot('is_corresponding', 'is_ketua')
            ->withDefault(['is_corresponding' => false, 'is_ketua' => false]);
    }

    public function statusLaporan(): BelongsTo
    {
        return $this->belongsTo(StatusLaporan::class);
    }

    public function jenisPenelitian(): BelongsTo
    {
        return $this->belongsTo(JenisPenelitian::class);
    }

    public function mitra(): BelongsTo
    {
        return $this->belongsTo(Mitra::class);
    }

    public function jenisOutput(): BelongsTo
    {
        return $this->belongsTo(JenisOutput::class);
    }

    public function publikasi(): HasOne
    {
        return $this->hasOne(Publikasi::class);
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
