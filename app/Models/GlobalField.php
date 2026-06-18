<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalField extends Model
{
    protected $fillable = [

        'code',

        'name',

        'data_type',

        'is_searchable',

        'is_filterable'
    ];

    protected $casts = [

        'is_searchable' => 'boolean',

        'is_filterable' => 'boolean',
    ];

    public function mappings()
    {
        return $this->hasMany(
            SourceFieldMapping::class
        );
    }
}