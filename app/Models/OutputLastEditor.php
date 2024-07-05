<?php

namespace App\Models;

use App\Models\User;
use App\Models\OutputDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OutputLastEditor extends Model
{
    use HasFactory;

    protected $table = 'output_last_editor';

    protected $fillable = [
        'output_detail_id',
        'user_id',
    ];

    public function outputDetail(): BelongsTo
    {
        return $this->belongsTo(OutputDetail::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
