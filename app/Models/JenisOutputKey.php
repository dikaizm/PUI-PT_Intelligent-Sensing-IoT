<?php

namespace App\Models;

use App\Models\JenisOutput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisOutputKey extends Model
{
    use HasFactory;

    protected $table = 'jenis_output_key';

    protected $fillable = ['name'];

    public function jenisOutput(): HasMany
    {
        return $this->hasMany(JenisOutput::class);
    }
}
