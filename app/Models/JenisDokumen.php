<?php

namespace App\Models;

use App\Models\Output;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisDokumen extends Model
{
    use HasFactory;

    protected $table = 'jenis_dokumen';

    protected $fillable = ['name'];

    public function outputs(): HasMany
    {
        return $this->hasMany(Output::class);
    }
}
