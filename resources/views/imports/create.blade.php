@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto p-6">

    <div class="bg-white rounded-lg shadow">

        <div class="border-b p-6">

            <h1 class="text-2xl font-bold">

                Nueva Importación

            </h1>

        </div>

        <form
            method="POST"
            action="{{ route('imports.store') }}"
            class="p-6 space-y-6">

            @csrf

            <div>

                <label
                    class="block text-sm font-medium mb-2">

                    Fuente

                </label>

                <select
                    name="source_id"
                    class="w-full border rounded-lg p-3"
                    required>

                    <option value="">
                        Seleccione una fuente
                    </option>

                    @foreach($sources as $source)

                        <option
                            value="{{ $source->id }}">

                            {{ $source->name }}

                            ({{ strtoupper($source->source_type) }})

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label
                    class="block text-sm font-medium mb-2">

                    Archivo

                </label>

                <select
                    name="file_path"
                    class="w-full border rounded-lg p-3"
                    required>

                    <option value="">
                        Seleccione un archivo
                    </option>

                    @foreach($files as $file)

                        <option
                            value="{{ $file['path'] }}">

                            {{ $file['name'] }}

                            ({{ number_format(
                                $file['size'] / 1024 / 1024,
                                2
                            ) }} MB)

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <button
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg">

                    Crear Importación

                </button>

            </div>

        </form>

    </div>

</div>

@endsection