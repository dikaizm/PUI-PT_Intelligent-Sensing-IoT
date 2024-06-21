<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusOutput extends Model
{
    use HasFactory;

    protected $table = 'status_output';

    protected $fillable = ['name'];

    public function outputDetails(): HasMany
    {
        return $this->hasMany(OutputDetail::class);
    }
}
