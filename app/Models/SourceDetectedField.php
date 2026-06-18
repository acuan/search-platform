<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourceDetectedField extends Model
{
    protected $fillable = [

        'source_id',

        'field_name',

        'data_type',
    ];

    public function source()
    {
        return $this->belongsTo(
            Source::class
        );
    }
}