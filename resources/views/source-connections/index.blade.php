@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <div class="flex justify-between">

        <h1 class="text-2xl font-bold">
            Conexiones
        </h1>

        <a
            href="{{ route('source-connections.create') }}"
            class="px-4 py-2 bg-indigo-600 text-white rounded">

            Nueva Conexión

        </a>

    </div>

    <div class="bg-white rounded-xl shadow">

        <table class="w-full">

            <thead class="bg-gray-50">

                <tr>

                    <th class="p-4 text-left">
                        Fuente
                    </th>

                    <th class="p-4 text-left">
                        Host
                    </th>

                    <th class="p-4 text-left">
                        Base
                    </th>

                    <th class="p-4 text-left">
                        Puerto
                    </th>

                    <th class="p-4">
                    </th>

                </tr>

            </thead>

            <tbody>

            @foreach($connections as $connection)

                <tr class="border-t">

                    <td class="p-4">
                        {{ $connection->source->name }}
                    </td>

                    <td class="p-4">
                        {{ $connection->host }}
                    </td>

                    <td class="p-4">
                        {{ $connection->database }}
                    </td>

                    <td class="p-4">
                        {{ $connection->port }}
                    </td>

                    <td class="p-4 text-right">

                        <a
                            href="{{ route(
                                'source-connections.edit',
                                $connection
                            ) }}"
                            class="text-blue-600">

                            Editar

                        </a>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection