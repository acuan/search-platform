@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <div class="bg-white rounded-lg shadow">

        <div class="border-b p-6">

            <h1 class="text-2xl font-bold">

                Mapeo de Campos

            </h1>

            <p class="text-gray-500 mt-2">

                {{ $source->name }}

            </p>

        </div>

        <form
            method="POST"
            action="{{ route(
                'sources.mappings.store',
                $source
            ) }}">

            @csrf

            <div class="p-6">

                <table class="w-full">

                    <thead>

                    <tr>

                        <th class="text-left p-3">

                            Campo Detectado

                        </th>

                        <th class="text-left p-3">

                            Campo Global

                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($fields as $field)

                        <tr class="border-t">

                            <td class="p-3">

                                {{ $field->field_name }}

                            </td>

                            <td class="p-3">

                                <select
                                    name="mappings[{{ $field->field_name }}]"
                                    class="w-full border rounded p-2">

                                    <option value="">
                                        Sin mapear
                                    </option>

                                    @foreach(
                                        $globalFields
                                        as $globalField
                                    )

                                        <option
                                            value="{{ $globalField->id }}"
                                            @selected(
                                                ($existingMappings[$field->field_name] ?? null)
                                                ==
                                                $globalField->id
                                            )>

                                            {{ $globalField->name }}
                                            ({{ $globalField->code }})

                                        </option>

                                    @endforeach

                                </select>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="2"
                                class="p-6 text-center text-gray-500">

                                No hay campos detectados

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="border-t p-6">

                <button
                    class="bg-blue-600 text-white px-6 py-2 rounded">

                    Guardar Mapeos

                </button>

            </div>

        </form>

    </div>

</div>

@endsection