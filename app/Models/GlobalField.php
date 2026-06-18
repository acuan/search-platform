<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalField extends Model
{
    protected $fillable = [
        'name',
        'label',
        'data_type',
        'searchable',
        'visible'
    ];

    protected $casts = [
        'searchable' => 'boolean',
        'visible' => 'boolean',
    ];

    public function mappings()
    {
        return $this->hasMany(SourceFieldMapping::class);
    }
}
