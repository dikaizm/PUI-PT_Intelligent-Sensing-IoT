<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetPenelitian extends Model
{
    use HasFactory;

    protected $fillable = ['tahun', 'target'];
    protected $table = 'target_penelitian';
}
