<?php

namespace App\Models;

use App\Models\StatusPenelitian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusPenelitianKey extends Model
{
    use HasFactory;
    protected $table = 'status_penelitian_key';

    protected $fillable = ['name'];

    public function statusPenelitians(): HasMany
    {
        return $this->hasMany(StatusPenelitian::class);
    }
}
