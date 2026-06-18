<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function index()
    {
        $sources = Source::latest()->paginate(20);

        return view(
            'sources.index',
            compact('sources')
        );
    }

    public function create()
    {
        return view('sources.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'code' => ['required','unique:sources'],
            'description' => ['nullable'],
            'source_type' => ['required'],
            'is_active' => ['boolean']
        ]);

        $source = Source::create($data);

        return redirect()
            ->route(
                'sources.connection.edit',
                $source
            )
            ->with(
                'success',
                'Fuente creada correctamente'
            );
    }

    public function edit(Source $source)
    {
        return view(
            'sources.edit',
            compact('source')
        );
    }

    public function show(Source $source)
    {
        $source->load([
            'connections',
            'fieldMappings.globalField',
            'imports'
        ]);

        return view(
            'sources.show',
            compact('source')
        );
    }

    public function update(
        Request $request,
        Source $source
    ) {
        $source->update(
            $request->validate([
                'name' => ['required'],
                'description' => ['nullable'],
                'is_active' => ['boolean']
            ])
        );

        return back()
            ->with(
                'success',
                'Fuente actualizada'
            );
    }

    public function destroy(Source $source)
    {
        $source->delete();

        return redirect()
            ->route('sources.index');
    }
}