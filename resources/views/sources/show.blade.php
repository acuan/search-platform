@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold">
                {{ $source->name }}
            </h1>

            <p class="text-gray-500 mt-1">
                {{ $source->description }}
            </p>

        </div>

        <div class="flex gap-2">

            <a
                href="{{ route('sources.edit', $source) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded">

                Editar

            </a>

            <a
                href="{{ route('sources.connection.edit', $source) }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded">

                Configurar Conexión

            </a>

        </div>

    </div>

    {{-- Información General --}}

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

        <div class="bg-white rounded-lg shadow p-6">

            <div class="text-sm text-gray-500">
                Código
            </div>

            <div class="font-bold mt-2">
                {{ $source->code }}
            </div>

        </div>

        <div class="bg-white rounded-lg shadow p-6">

            <div class="text-sm text-gray-500">
                Tipo
            </div>

            <div class="font-bold uppercase mt-2">
                {{ $source->source_type }}
            </div>

        </div>

        <div class="bg-white rounded-lg shadow p-6">

            <div class="text-sm text-gray-500">
                Estado
            </div>

            <div class="mt-2">

                @if($source->is_active)

                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded">

                        Activo

                    </span>

                @else

                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded">

                        Inactivo

                    </span>

                @endif

            </div>

        </div>

        <div class="bg-white rounded-lg shadow p-6">

            <div class="text-sm text-gray-500">
                Creada
            </div>

            <div class="font-bold mt-2">
                {{ $source->created_at?->format('d/m/Y') }}
            </div>

        </div>

    </div>

    {{-- Conexión --}}

    <div class="bg-white rounded-lg shadow mb-6">

        <div class="border-b p-4">

            <h2 class="font-semibold">
                Conexión
            </h2>

        </div>

        <div class="p-6">

            @if($source->connections->count())

                @foreach($source->connections as $connection)

                    <div class="mb-4">

                        <pre class="bg-gray-100 p-4 rounded overflow-auto text-sm">{{ json_encode($connection->config, JSON_PRETTY_PRINT) }}</pre>

                    </div>

                @endforeach

            @else

                <p class="text-gray-500">

                    No existe configuración de conexión.

                </p>

            @endif

        </div>

    </div>

    {{-- Mapeos --}}

    <div class="bg-white rounded-lg shadow mb-6">

        <div class="border-b p-4">

            <h2 class="font-semibold">
                Campos Mapeados
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left p-4">
                            Campo Origen
                        </th>

                        <th class="text-left p-4">
                            Campo Global
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($source->fieldMappings as $mapping)

                        <tr class="border-t">

                            <td class="p-4">

                                {{ $mapping->source_field }}

                            </td>

                            <td class="p-4">

                                {{ $mapping->globalField->label ?? '-' }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="2"
                                class="text-center p-6 text-gray-500">

                                No existen mapeos

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Importaciones --}}

    <div class="bg-white rounded-lg shadow">

        <div class="border-b p-4">

            <h2 class="font-semibold">
                Importaciones
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="p-4 text-left">
                            Archivo
                        </th>

                        <th class="p-4 text-left">
                            Estado
                        </th>

                        <th class="p-4 text-left">
                            Registros
                        </th>

                        <th class="p-4 text-left">
                            Fecha
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($source->imports as $import)

                        <tr class="border-t">

                            <td class="p-4">

                                {{ $import->filename }}

                            </td>

                            <td class="p-4">

                                {{ $import->status }}

                            </td>

                            <td class="p-4">

                                {{ $import->records_processed }}

                                /

                                {{ $import->records_total }}

                            </td>

                            <td class="p-4">

                                {{ $import->created_at->format('d/m/Y H:i') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="text-center p-6 text-gray-500">

                                No existen importaciones

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection