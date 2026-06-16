<?php

namespace App\Services;

use App\Models\Source;
use Illuminate\Support\Facades\DB;

class SourceConnectionService
{
    public function connect(Source $source)
    {
        $conn = $source->connection;

        config([
            'database.connections.dynamic' => [

                'driver' => $source->source_type,

                'host' => $conn->host,

                'port' => $conn->port,

                'database' => $conn->database,

                'username' => $conn->username,

                'password' => $conn->password,

                'charset' => 'utf8',

                'prefix' => '',
            ]
        ]);

        DB::purge('dynamic');

        return DB::connection('dynamic');
    }
}