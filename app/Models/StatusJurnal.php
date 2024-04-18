<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusJurnal extends Model
{
    use HasFactory;

    protected $table = 'status_jurnal';

    protected $fillable = ['name'];
}
