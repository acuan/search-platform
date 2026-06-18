<?php

namespace App\Services\Connectors;

use Illuminate\Support\Facades\DB;
use App\Services\Connectors\Contracts\SourceConnectorInterface;

class SqlServerConnector implements SourceConnectorInterface
{
    protected string $connectionName;

    public function __construct(array $config)
    {
        $this->connectionName = 'dynamic_pg';

        config([
            "database.connections.{$this->connectionName}" => [
                'driver' => 'sqlsrv',
                'host' => $config['host'],
                'port' => $config['port'],
                'database' => $config['database'],
                'username' => $config['username'],
                'password' => $config['password'],
                'charset' => 'utf8',
                'schema' => 'public',
            ]
        ]);
    }

    protected function connection()
    {
        return DB::connection(
            $this->connectionName
        );
    }

    public function testConnection(): bool
    {
        try {
            $this->connection()->getPdo();
            return true;
        } catch (\Exception) {
            return false;
        }
    }

    public function getFields(): array
    {
        $table = $this->config()['table'];

        return collect(
            $this->connection()
                ->select("
                    SELECT column_name
                    FROM information_schema.columns
                    WHERE table_name = ?
                ", [$table])
        )->pluck('column_name')
         ->toArray();
    }

    public function countRecords(): int
    {
        return $this->connection()
            ->table(
                $this->config()['table']
            )
            ->count();
    }

    public function readChunk(
        int $offset,
        int $limit
    ): array {

        return $this->connection()
            ->table(
                $this->config()['table']
            )
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->toArray();
    }

    protected function config()
    {
        return config(
            "database.connections.{$this->connectionName}"
        );
    }
}