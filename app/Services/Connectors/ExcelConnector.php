<?php

namespace App\Services\Connectors;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Services\Connectors\Contracts\SourceConnectorInterface;

class ExcelConnector implements SourceConnectorInterface
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function sheet()
    {
        $file = storage_path(
            'app/' . $this->config['file_path']
        );

        $spreadsheet = IOFactory::load($file);

        return $spreadsheet->getActiveSheet();
    }

    public function testConnection(): bool
    {
        return file_exists(
            storage_path('app/' . $this->config['file_path'])
        );
    }

    public function getFields(): array
    {
        $rows = $this->sheet()
            ->toArray();

        return $rows[0];
    }

    public function countRecords(): int
    {
        return count(
            $this->sheet()->toArray()
        ) - 1;
    }

    public function readChunk(
        int $offset,
        int $limit
    ): array {

        return collect(
            $this->sheet()->toArray()
        )
        ->slice($offset + 1, $limit)
        ->values()
        ->toArray();
    }

    public function getTables(): array
    {
        $spreadsheet =
            IOFactory::load(
                storage_path(
                    'app/' .
                    $this->config['file_path']
                )
            );

        return $spreadsheet
            ->getSheetNames();
    }
}