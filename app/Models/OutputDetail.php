<?php

namespace App\Models;

use App\Models\Output;
use App\Models\JenisOutput;
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
        'jenis_output_id',
        'status_output_id',
        'judul',
        'tautan',
        'file',
    ];

    public function output(): BelongsTo
    {
        return $this->belongsTo(Output::class);
    }
    public function jenisOutput(): BelongsTo
    {
        return $this->belongsTo(JenisOutput::class);
    }
    public function statusOutput(): BelongsTo
    {
        return $this->belongsTo(StatusOutput::class);
    }
}
