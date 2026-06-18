<?php

namespace App\Services\Connectors;

use League\Csv\Reader;
use App\Services\Connectors\Contracts\SourceConnectorInterface;

class CsvConnector implements SourceConnectorInterface
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function reader(): Reader
    {
        $csv = Reader::createFromPath(
            storage_path('app/' . $this->config['file_path']),
            'r'
        );

        $csv->setDelimiter(
            $this->config['delimiter'] ?? ','
        );

        if ($this->config['header_row'] ?? true) {
            $csv->setHeaderOffset(0);
        }

        return $csv;
    }

    public function testConnection(): bool
    {
        return file_exists(
            storage_path('app/' . $this->config['file_path'])
        );
    }

    public function getFields(): array
    {
        return $this->reader()->getHeader();
    }

    public function countRecords(): int
    {
        return iterator_count(
            $this->reader()->getRecords()
        );
    }

    public function readChunk(
        int $offset,
        int $limit
    ): array {
        return collect(
            $this->reader()->getRecords()
        )
        ->slice($offset, $limit)
        ->values()
        ->toArray();
    }

    public function getTables(): array
    {
        return [
            basename(
                $this->config['file_path']
            )
        ];
    }
}