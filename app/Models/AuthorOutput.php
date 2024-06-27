<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorOutput extends Model
{
    use HasFactory;

    protected $table = 'author_output';

    protected $fillable = [
        'author_id',
        'output_detail_id',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function outputDetail()
    {
        return $this->belongsTo(OutputDetail::class);
    }
}
