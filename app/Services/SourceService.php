<?php

namespace App\Services;

use App\Models\Source;
use App\Services\Connectors\SourceConnectorFactory;

class SourceService
{
    public function testConnection(
        Source $source
    ): bool {

        $connector = SourceConnectorFactory::make(
            $source
        );

        return $connector->testConnection();
    }

    public function getTables(
        Source $source
    ): array {

        return SourceConnectorFactory::make($source)
            ->getTables();
    }

    public function getFields(
        Source $source
    ): array {

        return SourceConnectorFactory::make($source)
            ->getFields();
    }

    public function countRecords(
        Source $source
    ): int {

        return SourceConnectorFactory::make($source)
            ->countRecords();
    }
}