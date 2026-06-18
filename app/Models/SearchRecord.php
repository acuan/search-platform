<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SearchRecord extends Model
{
    protected $fillable = [
        'source_id',
        'external_id',
        'data'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }
}
