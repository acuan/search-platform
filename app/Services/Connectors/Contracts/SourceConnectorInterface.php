<?php

namespace App\Services\Connectors\Contracts;

interface SourceConnectorInterface
{
    public function testConnection(): bool;

    public function getTables(): array;

    public function getFields(): array;

    public function countRecords(): int;

    public function readChunk(
        int $offset,
        int $limit
    ): array;
}