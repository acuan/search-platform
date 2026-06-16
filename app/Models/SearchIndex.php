<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchIndex extends Model
{
    protected $fillable = [
        'source_id',
        'index_name',
        'documents_count',
        'last_sync_at'
    ];

    protected $casts = [
        'last_sync_at' => 'datetime'
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
