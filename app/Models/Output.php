<?php

namespace App\Models;

use App\Models\Publisher;
use App\Models\Penelitian;
use App\Models\JenisDokumen;
use App\Models\StatusOutput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Output extends Model
{
    use HasFactory;

    protected $table = 'output';

    protected $fillable = [
        'jenis_dokumen_id',
        'penelitian_id',
        'publisher_id',
        'status_output_id',
        'keterangan',
        'tautan',
    ];

    public function jenisDokumen(): BelongsTo
    {
        return $this->belongsTo(JenisDokumen::class);
    }
    public function penelitian(): BelongsTo
    {
        return $this->belongsTo(Penelitian::class);
    }
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }
    public function statusOutput(): BelongsTo
    {
        return $this->belongsTo(StatusOutput::class);
    }
}
