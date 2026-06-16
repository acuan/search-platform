<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'source_type',
        'active'
    ];

    public function connection()
    {
        return $this->hasOne(SourceConnection::class);
    }

    public function mappings()
    {
        return $this->hasMany(SourceFieldMapping::class);
    }

    public function imports()
    {
        return $this->hasMany(Import::class);
    }

    public function searchLogs()
    {
        return $this->hasMany(SearchLog::class);
    }

    public function searchIndexes()
    {
        return $this->hasMany(SearchIndex::class);
    }


}
