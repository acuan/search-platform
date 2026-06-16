<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SourceConnection extends Model
{
    protected $fillable = [
        'source_id',
        'host',
        'port',
        'database',
        'schema',
        'username',
        'password',
        'table_name',
        'file_path',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array'
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
