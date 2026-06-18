<?php

namespace App\Jobs;

use App\Models\Import;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ProcessImportJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $timeout = 0;

    public int $tries = 1;

    protected int $chunkSize = 5000;

    public function __construct(
        public int $importId
    ) {
    }

    public function handle(): void
    {
        $import = Import::findOrFail(
            $this->importId
        );

        $import->update([
            'status' => 'processing',
            'started_at' => now(),
            'records_total' => 0,
            'records_processed' => 0,
            'processed_chunks' => 0,
            'total_chunks' => 0,
            'error_message' => null,
        ]);

        $file = $import->storage_path;

        if (! file_exists($file)) {

            throw new \Exception(
                "Archivo no encontrado: {$file}"
            );
        }

        $handle = fopen($file, 'r');

        if (! $handle) {

            throw new \Exception(
                "No se pudo abrir el archivo"
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Encabezados
        |--------------------------------------------------------------------------
        */

        $header = fgetcsv($handle);

        if (! $header) {

            throw new \Exception(
                'El archivo no contiene encabezados'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Lectura por chunks
        |--------------------------------------------------------------------------
        */

        $chunk = [];

        $chunkNumber = 1;

        $recordsTotal = 0;

        while (($row = fgetcsv($handle)) !== false) {

            if (
                count($row)
                !== count($header)
            ) {
                continue;
            }

            $chunk[] = array_combine(
                $header,
                $row
            );

            $recordsTotal++;

            if (
                count($chunk)
                >= $this->chunkSize
            ) {

                ProcessImportChunkJob::dispatch(
                    $import->id,
                    $chunk,
                    $chunkNumber
                );

                $chunk = [];

                $chunkNumber++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Último chunk
        |--------------------------------------------------------------------------
        */

        if (! empty($chunk)) {

            ProcessImportChunkJob::dispatch(
                $import->id,
                $chunk,
                $chunkNumber
            );
        }

        fclose($handle);

        /*
        |--------------------------------------------------------------------------
        | Estadísticas
        |--------------------------------------------------------------------------
        */

        $totalChunks = (int) ceil(
            $recordsTotal / $this->chunkSize
        );

        $import->update([

            'records_total' => $recordsTotal,

            'total_chunks' => $totalChunks,
        ]);
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

            'status' => 'failed',

            'error_message' =>
                $exception->getMessage(),
        ]);
    }
}