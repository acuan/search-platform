@extends('layouts.app')

@section('content')

<div class="p-6">

    <div class="flex justify-between mb-6">

        <h1 class="text-2xl font-bold">

            Importaciones

        </h1>

        <a
            href="{{ route('imports.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded">

            Nueva Importación

        </a>

    </div>

    <table class="w-full bg-white shadow rounded">

        <thead>

        <tr>

            <th class="p-3 text-left">
                Archivo
            </th>

            <th class="p-3 text-left">
                Estado
            </th>

            <th class="p-3 text-left">
                Progreso
            </th>

        </tr>

        </thead>

        <tbody>

        @foreach($imports as $import)

            <tr class="border-t">

                <td class="p-3">

                    {{ $import->filename }}

                </td>

                <td class="p-3">

                    {{ $import->status }}

                </td>

                <td class="p-3">

                    {{ $import->records_processed }}

                    /

                    {{ $import->records_total }}

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection