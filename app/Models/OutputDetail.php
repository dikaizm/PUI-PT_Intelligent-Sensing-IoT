<?php

namespace App\Models;

use App\Models\Output;
use App\Models\Publisher;
use App\Models\JenisDokumen;
use App\Models\StatusOutput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OutputDetail extends Model
{
    use HasFactory;

    protected $table = 'output_detail';

    protected $fillable = [
        'output_id',
        'jenis_dokumen_id',
        'publisher_id',
        'status_output_id',
        'keterangan',
        'tautan',
    ];

    public function output(): BelongsTo
    {
        return $this->belongsTo(Output::class);
    }
    public function jenisDokumen(): BelongsTo
    {
        return $this->belongsTo(JenisDokumen::class);
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
