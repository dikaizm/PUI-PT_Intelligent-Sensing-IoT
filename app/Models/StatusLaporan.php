<?php

namespace App\Models;

use App\Models\JurnalArticle;
use App\Models\StatusLaporanKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusLaporan extends Model
{
    use HasFactory;

    protected $table = 'status_laporan';

    protected $fillable = ['name', 'status_laporan_key_id'];

    public function statusLaporanKey(): BelongsTo
    {
        return $this->belongsTo(StatusLaporanKey::class);
    }

    public function jurnalArticle(): HasOne
    {
        return $this->hasOne(JurnalArticle::class);
    }
}
