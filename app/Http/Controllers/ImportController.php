<?php

namespace App\Http\Controllers;

use App\Models\Import;
use App\Models\Source;
use App\Jobs\ProcessImportJob;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index()
    {
        $imports = Import::with('source')
            ->latest()
            ->paginate(20);

        return view(
            'imports.index',
            compact('imports')
        );
    }

    public function create()
    {
        $importPath = env(
            'IMPORTS_PATH',
            '/data/imports'
        );

        $files = collect(
            glob($importPath . '/*')
        )->map(function ($file) {

            return [
                'name' => basename($file),
                'path' => $file,
                'size' => filesize($file),
            ];
        });

        $sources = Source::where(
            'is_active',
            true
        )->orderBy('name')
         ->get();

        return view(
            'imports.create',
            compact(
                'files',
                'sources'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'source_id' => [
                'required',
                'exists:sources,id'
            ],
            'file_path' => [
                'required'
            ]
        ]);

        $file = $request->file_path;

        $import = Import::create([

            'source_id' => $request->source_id,

            'filename' => basename($file),

            'storage_path' => $file,

            'file_size' => file_exists($file)
                ? filesize($file)
                : 0,

            'status' => 'pending',
        ]);

        ProcessImportJob::dispatch(
            $import->id
        );

        return redirect()
            ->route('imports.show', $import)
            ->with(
                'success',
                'Importación creada correctamente'
            );
    }

    public function show(Import $import)
    {
        $import->load('source');

        return view(
            'imports.show',
            compact('import')
        );
    }
}