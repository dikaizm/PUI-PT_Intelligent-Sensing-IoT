<?php

namespace App\Models;

use App\Models\Output;
use App\Models\PublisherKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publisher extends Model
{
    use HasFactory;

    protected $table = 'publisher';

    protected $fillable = ['publisher_key_id', 'tingkat_index'];

    public function publisherKey(): BelongsTo
    {
        return $this->belongsTo(PublisherKey::class);
    }

    public function outputs(): HasMany
    {
        return $this->hasMany(Output::class);
    }
}
