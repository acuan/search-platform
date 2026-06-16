@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <div>

        <h1 class="text-3xl font-bold text-gray-900">
            Dashboard
        </h1>

        <p class="text-gray-500 mt-1">
            Plataforma de Búsqueda y Consolidación de Datos
        </p>

    </div>

    {{-- Estadísticas --}}

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl shadow p-6">

            <div class="text-sm text-gray-500">
                Fuentes
            </div>

            <div class="text-4xl font-bold mt-2">
                {{ $sourcesCount }}
            </div>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <div class="text-sm text-gray-500">
                Importaciones
            </div>

            <div class="text-4xl font-bold mt-2">
                {{ $importsCount }}
            </div>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <div class="text-sm text-gray-500">
                Búsquedas
            </div>

            <div class="text-4xl font-bold mt-2">
                {{ $searchesCount }}
            </div>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <div class="text-sm text-gray-500">
                Usuarios
            </div>

            <div class="text-4xl font-bold mt-2">
                {{ $usersCount }}
            </div>

        </div>

    </div>

    {{-- Estado del sistema --}}

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="bg-white rounded-xl shadow p-6">

            <h3 class="font-semibold text-lg mb-4">
                Estado del Sistema
            </h3>

            <div class="space-y-3">

                <div class="flex justify-between">

                    <span>Laravel</span>

                    <span class="text-green-600 font-medium">
                        Online
                    </span>

                </div>

                <div class="flex justify-between">

                    <span>PostgreSQL</span>

                    <span class="text-green-600 font-medium">
                        Conectado
                    </span>

                </div>

                <div class="flex justify-between">

                    <span>Redis</span>

                    <span class="text-green-600 font-medium">
                        Conectado
                    </span>

                </div>

                <div class="flex justify-between">

                    <span>OpenSearch</span>

                    <span class="text-green-600 font-medium">
                        Conectado
                    </span>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-xl shadow p-6 lg:col-span-2">

            <h3 class="font-semibold text-lg mb-4">
                Resumen
            </h3>

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <div class="text-gray-500 text-sm">
                        Fuentes Activas
                    </div>

                    <div class="text-3xl font-bold mt-2">
                        {{ \App\Models\Source::where('active',1)->count() }}
                    </div>

                </div>

                <div>

                    <div class="text-gray-500 text-sm">
                        Importaciones Procesadas
                    </div>

                    <div class="text-3xl font-bold mt-2">
                        {{ \App\Models\Import::where('status','completed')->count() }}
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Últimas Fuentes --}}

    <div class="bg-white rounded-xl shadow">

        <div class="p-6 border-b">

            <h3 class="font-semibold text-lg">
                Últimas Fuentes Registradas
            </h3>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left p-4">
                            Nombre
                        </th>

                        <th class="text-left p-4">
                            Código
                        </th>

                        <th class="text-left p-4">
                            Tipo
                        </th>

                        <th class="text-left p-4">
                            Estado
                        </th>

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

                            @if($source->active)

                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                    Activo
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">
                                    Inactivo
                                </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4"
                            class="p-6 text-center text-gray-500">

                            No hay registros

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection