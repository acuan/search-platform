<?php

namespace App\Jobs;

use App\Models\Import;
use App\Services\FieldMappingService;
use App\Services\SearchIndexerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ProcessImportChunkJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $timeout = 1200;

    public int $tries = 3;

    public function __construct(
        public int $importId,
        public array $rows,
        public int $chunkNumber
    ) {
    }

    public function handle(
        SearchIndexerService $indexer,
        FieldMappingService $mappingService
    ): void {

        $import = Import::with([
            'source',
            'source.fieldMappings.globalField'
        ])->findOrFail(
            $this->importId
        );

        $documents = [];

        foreach ($this->rows as $row) {

            $normalized =
                $mappingService
                    ->normalize(
                        $import->source,
                        $row
                    );

            $fullText =
                $mappingService
                    ->buildSearchText(
                        $normalized
                    );

            $documents[] = [

                'import_id' =>
                    $import->id,

                'source_id' =>
                    $import->source_id,

                'source_name' =>
                    $import->source->name,

                'indexed_at' =>
                    now()->toIso8601String(),

                'chunk_number' =>
                    $this->chunkNumber,

                'full_text' =>
                    $fullText,

                'normalized_data' =>
                    $normalized,

                'original_data' =>
                    $row,
            ];
        }

        $indexer->bulkIndex(
            $documents
        );

        $import->increment(
            'processed_chunks'
        );

        $import->increment(
            'records_processed',
            count($this->rows)
        );

        $import->refresh();

        if (
            $import->processed_chunks >=
            $import->total_chunks
        ) {

            $import->update([

                'status' =>
                    'completed',

                'completed_at' =>
                    now(),
            ]);
        }
    }

    public function failed(
        Throwable $exception
    ): void {

        $import = Import::find(
            $this->importId
        );

        if (! $import) {
            return;
        }

        $import->update([

            'status' =>
                'failed',

            'error_message' =>
                $exception->getMessage(),
        ]);
    }
}