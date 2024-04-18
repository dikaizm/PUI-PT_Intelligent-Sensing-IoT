<?php

namespace App\Models;

use App\Models\Publisher;
use App\Models\StatusJurnal;
use App\Models\JurnalArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publikasi extends Model
{
    use HasFactory;

    protected $table = 'publikasi';

    protected $fillable = [
        'jurnal_article_id',
        'publisher_id',
        'status_jurnal_id',
        'indexing',
        'link_jurnal',
    ];

    public function jurnalArticle(): BelongsTo
    {
        return $this->belongsTo(JurnalArticle::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function statusJurnal(): BelongsTo
    {
        return $this->belongsTo(StatusJurnal::class);
    }
}
