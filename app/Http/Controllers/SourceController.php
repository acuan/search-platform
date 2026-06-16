<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Source;
use App\Services\SourceConnectionService;



class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sources = Source::paginate();

        return view('sources.index', compact('sources'));
    }

    public function create()
    {
        return view('sources.create');
    }

    public function store(Request $request)
    {
        Source::create(
            $request->validate([
                'name' => 'required',
                'code' => 'required|unique:sources',
                'description' => 'nullable',
                'source_type' => 'required',
                'active' => 'boolean'
            ])
        );

        return redirect()->route('sources.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function test(Source $source)
    {
        try {

            app(SourceConnectionService::class)
                ->connect($source)
                ->getPdo();

            return back()->with(
                'success',
                'Conexión exitosa'
            );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function columns(Source $source)
    {
        $db = app(SourceConnectionService::class)
            ->connect($source);

        $columns = $db->select("
            SELECT column_name
            FROM information_schema.columns
            WHERE table_name = ?
        ", [
            $source->connection->table_name
        ]);

        return $columns;
    }
}
