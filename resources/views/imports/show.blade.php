@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto p-6">

    <div class="bg-white rounded-lg shadow">

        <div class="border-b p-6">

            <h1 class="text-2xl font-bold">

                {{ $import->filename }}

            </h1>

        </div>

        <div class="p-6">

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <div class="text-gray-500">
                        Fuente
                    </div>

                    <div class="font-bold">

                        {{ $import->source->name }}

                    </div>

                </div>

                <div>

                    <div class="text-gray-500">
                        Estado
                    </div>

                    <div class="font-bold">

                        {{ $import->status }}

                    </div>

                </div>

                <div>

                    <div class="text-gray-500">
                        Registros
                    </div>

                    <div class="font-bold">

                        {{ $import->records_processed }}

                        /

                        {{ $import->records_total }}

                    </div>

                </div>

                <div>

                    <div class="text-gray-500">
                        Tamaño
                    </div>

                    <div class="font-bold">

                        {{ number_format(
                            $import->file_size / 1024 / 1024,
                            2
                        ) }} MB

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="mt-8">

    <div class="mb-2">

        Progreso

    </div>

    <div class="w-full bg-gray-200 rounded-full h-4">

            <div
                class="bg-green-500 h-4 rounded-full"
                style="
                    width:
                    {{
                        $import->records_total > 0
                        ? ($import->records_processed * 100 / $import->records_total)
                        : 0
                    }}%;
                ">
            </div>

        </div>

    </div>
</div>

@endsection