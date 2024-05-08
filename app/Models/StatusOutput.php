<?php

namespace App\Models;

use App\Models\Output;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusOutput extends Model
{
    use HasFactory;

    protected $table = 'status_output';

    protected $fillable = ['name'];

    public function output(): HasMany
    {
        return $this->hasMany(Output::class);
    }
}
