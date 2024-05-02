<?php

namespace App\Models;

use App\Models\Penelitian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mitra extends Model
{
    use HasFactory;

    protected $table = 'mitra';

    protected $fillable = ['name'];

    public function penelitians(): HasMany
    {
        return $this->hasMany(Penelitian::class);
    }
}
