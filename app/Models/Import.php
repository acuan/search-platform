<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $fillable = [
        'source_id',
        'filename',
        'storage_path',
        'file_size',
        'status',
        'records_total',
        'records_processed',
        'error_message',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function source()
    {
        return $this->belongsTo(
            Source::class
        );
    }
}