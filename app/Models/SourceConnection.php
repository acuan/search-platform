<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourceConnection extends Model
{
    protected $fillable = [
        'source_id',
        'name',
        'config',
        'is_active',
    ];

    protected $casts = [
        'config' => 'array',
        'is_active' => 'boolean',
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function getConfigValue(string $key): mixed
    {
        return data_get($this->config, $key);
    }
}
