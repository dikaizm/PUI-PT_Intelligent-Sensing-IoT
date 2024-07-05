<?php

namespace App\Models;

use App\Models\User;
use App\Models\Penelitian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenelitianLastEditor extends Model
{
    use HasFactory;

    protected $table = 'penelitian_last_editor';

    protected $fillable = [
        'penelitian_id',
        'user_id',
    ];

    public function penelitian(): BelongsTo
    {
        return $this->belongsTo(Penelitian::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
