<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Source extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'source_type',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function connection()
    {
        return $this->hasMany(SourceConnection::class);
    }

    public function fieldMappings()
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

    public function searchRecords()
    {
        return $this->hasMany(SearchRecord::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function getActiveConnectionAttribute(): ?SourceConnection
    {
        return $this->connections()
            ->where('is_active', true)
            ->first();
    }

    public function connections()
    {
        return $this->hasMany(
            SourceConnection::class
        );
    }

    public function activeConnection()
    {
        return $this->hasOne(
            SourceConnection::class
        )->where(
            'is_active',
            true
        );
    }

    public function detectedFields()
    {
        return $this->hasMany(
            SourceDetectedField::class
        );
    }




}
