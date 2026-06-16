@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>
        <h2 class="text-2xl font-bold">
            Fuentes de Datos
        </h2>

        <p class="text-gray-500">
            Administración de orígenes de información
        </p>
    </div>

    <a
        href="{{ route('sources.create') }}"
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">

        Nueva Fuente

    </a>

</div>

@if(session('success'))

<div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">

    {{ session('success') }}

</div>

@endif

<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-50">

            <tr>

                <th class="text-left p-4">ID</th>

                <th class="text-left p-4">Nombre</th>

                <th class="text-left p-4">Código</th>

                <th class="text-left p-4">Tipo</th>

                <th class="text-left p-4">Estado</th>

                <th class="text-right p-4">
                    Acciones
                </th>

            </tr>

        </thead>

        <tbody>

        @forelse($sources as $source)

            <tr class="border-t">

                <td class="p-4">
                    {{ $source->id }}
                </td>

                <td class="p-4 font-medium">
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

                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm">
                            Activo
                        </span>

                    @else

                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm">
                            Inactivo
                        </span>

                    @endif

                </td>

                <td class="p-4">

                    <div class="flex justify-end gap-2">

                        <a
                            href="{{ route('sources.show',$source) }}"
                            class="px-3 py-2 bg-blue-500 text-white rounded">

                            Ver

                        </a>

                        <a
                            href="{{ route('sources.edit',$source) }}"
                            class="px-3 py-2 bg-yellow-500 text-white rounded">

                            Editar

                        </a>

                        <form
                            action="{{ route('sources.destroy',$source) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('¿Eliminar registro?')"
                                class="px-3 py-2 bg-red-600 text-white rounded">

                                Eliminar

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6"
                    class="p-10 text-center text-gray-500">

                    No existen fuentes registradas

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="mt-6">

    {{ $sources->links() }}

</div>

@endsection