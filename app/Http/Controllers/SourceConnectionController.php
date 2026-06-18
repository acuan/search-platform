<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\SourceConnection;
use App\Services\SourceService;
use Illuminate\Http\Request;

class SourceConnectionController extends Controller
{
    public function edit(Source $source)
    {
        $connection = $source
            ->connections()
            ->first();

        return view(
            'sources.connection',
            compact(
                'source',
                'connection'
            )
        );
    }


    public function update(
        Request $request,
        Source $source
    ) {

        $connection = $source
            ->connections()
            ->first();

        $existingConfig = $connection?->config ?? [];

        /*
        |--------------------------------------------------------------------------
        | Archivos
        |--------------------------------------------------------------------------
        */

        $csvPath = $existingConfig['file_path'] ?? null;

        if ($request->hasFile('csv_file')) {

            $csvPath = $request
                ->file('csv_file')
                ->store(
                    'imports/csv',
                    'local'
                );
        }

        $excelPath = $existingConfig['file_path'] ?? null;

        if ($request->hasFile('excel_file')) {

            $excelPath = $request
                ->file('excel_file')
                ->store(
                    'imports/excel',
                    'local'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Configuración por tipo
        |--------------------------------------------------------------------------
        */

        $config = match ($source->source_type) {

            'postgresql' => [

                'host' => $request->host,

                'port' => $request->port ?: 5432,

                'database' => $request->database,

                'username' => $request->username,

                'password' => filled($request->password)
                    ? encrypt($request->password)
                    : ($existingConfig['password'] ?? null),

                'schema' => $request->schema ?: 'public',

                'table' => $request->table,
            ],

            'mysql' => [

                'host' => $request->host,

                'port' => $request->port ?: 3306,

                'database' => $request->database,

                'username' => $request->username,

                'password' => filled($request->password)
                    ? encrypt($request->password)
                    : ($existingConfig['password'] ?? null),

                'table' => $request->table,
            ],

            'csv' => [

                'file_path' => $csvPath,

                'delimiter' => $request->delimiter ?: ',',

                'header_row' => true,
            ],

            'excel' => [

                'file_path' => $excelPath,

                'sheet' => $request->sheet ?: 'Sheet1',
            ],

            default => [],
        };

        /*
        |--------------------------------------------------------------------------
        | Guardar
        |--------------------------------------------------------------------------
        */

        SourceConnection::updateOrCreate(

            [
                'source_id' => $source->id,
            ],

            [
                'name' => 'Principal',

                'config' => $config,

                'is_active' => true,
            ]
        );

        return redirect()
            ->route(
                'sources.connection.edit',
                $source
            )
            ->with(
                'success',
                'Conexión guardada correctamente'
            );
    }

    public function test(
        Source $source,
        SourceService $service
    ) {

        try {

            $result = $service
                ->testConnection($source);

            return response()->json([
                'success' => true,
                'message' => 'Conexión exitosa'
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function detectTables(
        Source $source,
        SourceService $service
    ) {

        try {

            return response()->json([
                'success' => true,
                'tables' => $service
                    ->getTables($source)
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function detectFields(
        Source $source,
        SourceService $service
    ) {

        try {

            $fields =
                $service
                    ->getFields(
                        $source
                    );

            /*
            |--------------------------------------------------------------------------
            | Guardar detección
            |--------------------------------------------------------------------------
            */

            $source
                ->detectedFields()
                ->delete();

            foreach ($fields as $field) {

                $source
                    ->detectedFields()
                    ->create([

                        'field_name' => $field,

                        'data_type' => 'string'
                    ]);
            }

            return response()->json([

                'success' => true,

                'fields' => $fields
            ]);

        } catch (\Throwable $e) {

            return response()->json([

                'success' => false,

                'message' =>
                    $e->getMessage()

            ],500);
        }
    }
}