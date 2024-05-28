<?php

namespace App\Models;

use App\Models\Output;
use App\Models\JenisOutputKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisOutput extends Model
{
    use HasFactory;

    protected $table = 'jenis_output';

    protected $fillable = ['jenis_output_key_id', 'name'];

    public function jenisOutputKey(): BelongsTo
    {
        return $this->belongsTo(JenisOutputKey::class);
    }

    public function outputDetail(): HasMany
    {
        return $this->hasMany(Output::class);
    }
}
