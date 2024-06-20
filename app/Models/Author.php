<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'author';

    protected $attributes = [
        'is_corresponding' => false,
        'is_ketua' => false,
    ];

    protected $fillable = [
        'penelitian_id',
        'user_id',
        'is_corresponding',
        'is_ketua',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
