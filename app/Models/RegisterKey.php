<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RegisterKey extends Model
{
    use HasUuids;

    protected $table = 'register_keys';

    protected $fillable = ['key'];

    public function uniqueIds(): array
    {
        return ['key'];
    }
}
