<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportBatch extends Model
{
    protected $fillable = [
        'import_id',
        'batch_number',
        'records_count',
        'processed_count',
        'status'
    ];

    public function import()
    {
        return $this->belongsTo(Import::class);
    }
}
