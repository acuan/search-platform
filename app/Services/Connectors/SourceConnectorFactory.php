<?php

namespace App\Services\Connectors;

use App\Models\Source;

class SourceConnectorFactory
{
    public static function make(Source $source)
    {
        $connection = $source
            ->active_connection;

        $config = $connection->config;

        return match ($source->source_type) {

            'csv' => new CsvConnector($config),

            'excel' => new ExcelConnector($config),

            'postgresql' => new PostgresConnector($config),

            'mysql' => new MysqlConnector($config),

            'sqlserver' => new SqlServerConnector($config),

            default => throw new \Exception(
                "Tipo de fuente no soportado"
            ),
        };
    }

    public function getTables(
    Source $source
    ): array {

        return SourceConnectorFactory
            ::make($source)
            ->getTables();
    }
}