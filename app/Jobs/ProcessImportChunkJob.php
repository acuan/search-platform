<?php

namespace App\Jobs;

use App\Models\Import;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessImportChunkJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $importId,
        public array $rows,
        public int $chunkNumber
    ) {
    }

    public function handle(): void
    {
        $import = Import::findOrFail(
            $this->importId
        );

        /*
        |--------------------------------------------------------------------------
        | Aquí irá OpenSearch
        |--------------------------------------------------------------------------
        */

        foreach ($this->rows as $row) {

            /*
            SearchRecord::create(...)
            */

        }

        $import->increment(
            'processed_chunks'
        );

        $import->increment(
            'records_processed',
            count($this->rows)
        );

        if (
            $import->processed_chunks + 1
            >= $import->total_chunks
        ) {

            $import->update([
                'status' => 'completed',
                'completed_at' => now()
            ]);
        }
    }
}