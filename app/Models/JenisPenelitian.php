<?php

namespace App\Models;

use App\Models\JurnalArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisPenelitian extends Model
{
    use HasFactory;

    protected $table = 'jenis_penelitian';

    protected $fillable = ['name'];

    public function jurnalArticle(): HasOne
    {
        return $this->hasOne(JurnalArticle::class);
    }
}
