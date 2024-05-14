<?php

namespace App\Models;

use App\Models\Penelitian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Output extends Model
{
    use HasFactory;

    protected $table = 'output';

    protected $fillable = ['penelitian_id'];

    public function penelitian(): BelongsTo
    {
        return $this->belongsTo(Penelitian::class);
    }
}
