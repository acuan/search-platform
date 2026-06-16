<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $fillable = [
        'source_id',
        'user_id',
        'filename',
        'records_total',
        'records_processed',
        'records_failed',
        'status'
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function batches()
    {
        return $this->hasMany(ImportBatch::class);
    }
}
