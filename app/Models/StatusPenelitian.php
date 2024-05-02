<?php

namespace App\Models;

use App\Models\Penelitian;
use App\Models\StatusPenelitianKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusPenelitian extends Model
{
    use HasFactory;

    protected $table = 'status_penelitian';

    protected $fillable = ['name', 'status_penelitian_key_id'];

    public function statusPenelitianKey(): BelongsTo
    {
        return $this->belongsTo(StatusPenelitianKey::class);
    }

    public function penelitians(): HasMany
    {
        return $this->hasMany(Penelitian::class);
    }
}
