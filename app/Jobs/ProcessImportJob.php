<?php

namespace App\Jobs;

use App\Models\Import;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessImportJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Import $import
    ) {
    }

    public function handle(): void
    {
        $this->import->update([
            'status' => 'processing',
            'started_at' => now(),
        ]);

        $path = $this->import->storage_path;

        $handle = fopen($path, 'r');

        if (!$handle) {

            throw new \Exception(
                'No se pudo abrir el archivo'
            );
        }

        $header = fgetcsv($handle);

        $chunk = [];

        $chunkSize = 5000;

        $chunkNumber = 1;

        $records = 0;

        while (($row = fgetcsv($handle)) !== false) {

            $chunk[] = array_combine(
                $header,
                $row
            );

            $records++;

            if (
                count($chunk)
                >= $chunkSize
            ) {

                ProcessImportChunkJob::dispatch(
                    $this->import->id,
                    $chunk,
                    $chunkNumber
                );

                $chunk = [];

                $chunkNumber++;
            }
        }

        if (!empty($chunk)) {

            ProcessImportChunkJob::dispatch(
                $this->import->id,
                $chunk,
                $chunkNumber
            );
        }

        fclose($handle);

        $this->import->update([

            'records_total' => $records,

            'total_chunks' => $chunkNumber
        ]);
    }
}