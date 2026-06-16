<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\SourceConnection;
use Illuminate\Http\Request;

class SourceConnectionController extends Controller
{
    public function index()
    {
        $connections = SourceConnection::with('source')
            ->paginate(20);

        return view(
            'source-connections.index',
            compact('connections')
        );
    }

    public function create()
    {
        $sources = Source::orderBy('name')->get();

        return view(
            'source-connections.create',
            compact('sources')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'source_id' => 'required',
            'host' => 'nullable',
            'port' => 'nullable',
            'database' => 'nullable',
            'schema' => 'nullable',
            'username' => 'nullable',
            'password' => 'nullable',
            'table_name' => 'nullable',
            'file_path' => 'nullable',
        ]);

        SourceConnection::create($data);

        return redirect()
            ->route('source-connections.index')
            ->with(
                'success',
                'Conexión creada correctamente'
            );
    }

    public function edit(SourceConnection $sourceConnection)
    {
        $sources = Source::orderBy('name')->get();

        return view(
            'source-connections.edit',
            compact(
                'sourceConnection',
                'sources'
            )
        );
    }

    public function update(
        Request $request,
        SourceConnection $sourceConnection
    )
    {
        $data = $request->validate([
            'source_id' => 'required',
            'host' => 'nullable',
            'port' => 'nullable',
            'database' => 'nullable',
            'schema' => 'nullable',
            'username' => 'nullable',
            'password' => 'nullable',
            'table_name' => 'nullable',
            'file_path' => 'nullable',
        ]);

        $sourceConnection->update($data);

        return redirect()
            ->route('source-connections.index')
            ->with(
                'success',
                'Conexión actualizada'
            );
    }

    public function destroy(
        SourceConnection $sourceConnection
    )
    {
        $sourceConnection->delete();

        return back()
            ->with(
                'success',
                'Conexión eliminada'
            );
    }
}