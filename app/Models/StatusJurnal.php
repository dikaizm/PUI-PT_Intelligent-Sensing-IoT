<?php

namespace App\Models;

use App\Models\Output;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusJurnal extends Model
{
    use HasFactory;

    protected $table = 'status_jurnal';

    protected $fillable = ['name'];

    public function Output(): HasMany
    {
        return $this->hasMany(Output::class);
    }
}
