<?php

namespace App\Services;

use App\Models\Source;

class FieldMappingService
{
    public function normalize(
        Source $source,
        array $row
    ): array {

        $mappings = $source
            ->fieldMappings()
            ->with('globalField')
            ->get();

        $normalized = [];

        foreach ($mappings as $mapping) {

            $sourceField =
                $mapping->source_field;

            if (
                ! array_key_exists(
                    $sourceField,
                    $row
                )
            ) {
                continue;
            }

            $globalField =
                $mapping
                    ->globalField
                    ->code;

            $normalized[
                $globalField
            ] = $row[
                $sourceField
            ];
        }

        return $normalized;
    }

    public function buildSearchText(
        array $data
    ): string {

        return collect($data)
            ->filter()
            ->implode(' ');
    }
}