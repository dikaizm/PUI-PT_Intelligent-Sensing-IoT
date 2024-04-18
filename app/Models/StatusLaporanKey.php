<?php

namespace App\Models;

use App\Models\StatusLaporan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusLaporanKey extends Model
{
    use HasFactory;

    protected $table = 'status_laporan_key';

    protected $fillable = ['name'];

    public function statusLaporans(): HasMany
    {
        return $this->hasMany(StatusLaporan::class);
    }
}
