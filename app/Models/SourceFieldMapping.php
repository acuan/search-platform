<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourceFieldMapping extends Model
{
    protected $fillable = [
        'source_id',
        'global_field_id',
        'source_field'
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function globalField()
    {
        return $this->belongsTo(GlobalField::class);
    }
}
