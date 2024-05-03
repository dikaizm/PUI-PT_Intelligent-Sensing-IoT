<?php

namespace App\Models;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublisherKey extends Model
{
    use HasFactory;

    protected $table = 'publisher_key';

    protected $fillable = ['name'];

    public function publishers(): HasMany
    {
        return $this->hasMany(Publisher::class);
    }
}
