@extends('layouts.app')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-900">
            Dashboard
        </h1>

        <p class="text-gray-500 mt-2">
            Plataforma de Búsqueda y Consolidación de Datos
        </p>
    </div>

    {{-- KPIs --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="text-sm text-gray-500">
                Fuentes
            </div>

            <div class="text-4xl font-bold mt-2">
                {{ $sourcesCount ?? 0 }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="text-sm text-gray-500">
                Importaciones
            </div>

            <div class="text-4xl font-bold mt-2">
                {{ $importsCount ?? 0 }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="text-sm text-gray-500">
                Búsquedas
            </div>

            <div class="text-4xl font-bold mt-2">
                {{ $searchesCount ?? 0 }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="text-sm text-gray-500">
                Usuarios
            </div>

            <div class="text-4xl font-bold mt-2">
                {{ $usersCount ?? 0 }}
            </div>
        </div>

    </div>

    {{-- Resumen --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="bg-white rounded-xl shadow-sm border p-6">

            <h2 class="text-lg font-semibold mb-4">
                Estado del Sistema
            </h2>

            <div class="space-y-3">

                <div class="flex justify-between">
                    <span>Laravel</span>
                    <span class="text-green-600 font-semibold">
                        Online
                    </span>
                </div>

                <div class="flex justify-between">
                    <span>PostgreSQL</span>
                    <span class="text-green-600 font-semibold">
                        Conectado
                    </span>
                </div>

                <div class="flex justify-between">
                    <span>Redis</span>
                    <span class="text-green-600 font-semibold">
                        Conectado
                    </span>
                </div>

                <div class="flex justify-between">
                    <span>OpenSearch</span>
                    <span class="text-green-600 font-semibold">
                        Conectado
                    </span>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6 lg:col-span-2">

            <h2 class="text-lg font-semibold mb-6">
                Resumen General
            </h2>

            <div class="grid grid-cols-2 gap-8">

                <div>

                    <div class="text-sm text-gray-500">
                        Fuentes Activas
                    </div>

                    <div class="text-3xl font-bold mt-2">
                        {{ $activeSourcesCount ?? 0 }}
                    </div>

                </div>

                <div>

                    <div class="text-sm text-gray-500">
                        Importaciones Completadas
                    </div>

                    <div class="text-3xl font-bold mt-2">
                        {{ $completedImportsCount ?? 0 }}
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Fuentes por Tipo --}}
    <div class="bg-white rounded-xl shadow-sm border">

        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold">
                Fuentes por Tipo
            </h2>
        </div>

        <div class="p-6">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                @forelse($sourcesByType as $item)

                    <div class="border rounded-lg p-4">

                        <div class="text-gray-500 text-sm uppercase">
                            {{ $item->source_type }}
                        </div>

                        <div class="text-2xl font-bold mt-2">
                            {{ $item->total }}
                        </div>

                    </div>

                @empty

                    <div class="col-span-4 text-center text-gray-500">
                        Sin información
                    </div>

                @endforelse

            </div>

        </div>

    </div>

    {{-- Últimas Fuentes --}}
    <div class="bg-white rounded-xl shadow-sm border">

        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold">
                Últimas Fuentes Registradas
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>
                        <th class="text-left p-4">Nombre</th>
                        <th class="text-left p-4">Código</th>
                        <th class="text-left p-4">Tipo</th>
                        <th class="text-left p-4">Estado</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($recentSources as $source)

                        <tr class="border-t">

                            <td class="p-4">
                                {{ $source->name }}
                            </td>

                            <td class="p-4">
                                {{ $source->code }}
                            </td>

                            <td class="p-4 uppercase">
                                {{ $source->source_type }}
                            </td>

                            <td class="p-4">

                                @if($source->is_active)

                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">
                                        Activo
                                    </span>

                                @else

                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">
                                        Inactivo
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="p-8 text-center text-gray-500">
                                No hay fuentes registradas
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Últimas Búsquedas --}}
    <div class="bg-white rounded-xl shadow-sm border">

        <div class="p-6 border-b">

            <h2 class="text-lg font-semibold">
                Últimas Búsquedas
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>
                        <th class="text-left p-4">
                            Término
                        </th>

                        <th class="text-left p-4">
                            Resultados
                        </th>

                        <th class="text-left p-4">
                            Fecha
                        </th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($recentSearches as $search)

                        <tr class="border-t">

                            <td class="p-4">
                                {{ $search->search_term }}
                            </td>

                            <td class="p-4">
                                {{ $search->results_count }}
                            </td>

                            <td class="p-4">
                                {{ $search->created_at->format('d/m/Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3"
                                class="p-8 text-center text-gray-500">

                                No existen búsquedas registradas

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection