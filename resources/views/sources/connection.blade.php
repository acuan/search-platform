@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

```
<div class="bg-white rounded-lg shadow">

    <div class="border-b px-6 py-4">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-xl font-bold">
                    Configuración de Fuente
                </h1>

                <p class="text-gray-500 mt-1">
                    {{ $source->name }}
                </p>

            </div>

            <div>

                <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">

                    {{ strtoupper($source->source_type) }}

                </span>

            </div>

        </div>

    </div>

    <div class="p-6">

        <form
            method="POST"
            enctype="multipart/form-data"
            action="{{ route('sources.connection.update',$source) }}"
            class="space-y-6">

            @csrf

            @if(in_array($source->source_type,['postgresql','mysql']))

                <div class="grid grid-cols-2 gap-4">

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Host
                        </label>

                        <input
                            type="text"
                            name="host"
                            value="{{ $connection?->config['host'] ?? '' }}"
                            class="w-full border rounded-lg p-2">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Puerto
                        </label>

                        <input
                            type="text"
                            name="port"
                            value="{{ $connection?->config['port'] ?? '' }}"
                            class="w-full border rounded-lg p-2">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Base de Datos
                        </label>

                        <input
                            type="text"
                            name="database"
                            value="{{ $connection?->config['database'] ?? '' }}"
                            class="w-full border rounded-lg p-2">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Usuario
                        </label>

                        <input
                            type="text"
                            name="username"
                            value="{{ $connection?->config['username'] ?? '' }}"
                            class="w-full border rounded-lg p-2">

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="w-full border rounded-lg p-2">

                    </div>

                    @if($source->source_type === 'postgresql')

                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Schema
                            </label>

                            <input
                                type="text"
                                name="schema"
                                value="{{ $connection?->config['schema'] ?? 'public' }}"
                                class="w-full border rounded-lg p-2">

                        </div>

                    @endif

                    <div class="col-span-2">

                        <label class="block text-sm font-medium mb-2">
                            Tabla
                        </label>

                        <input
                            type="text"
                            name="table"
                            value="{{ $connection?->config['table'] ?? '' }}"
                            class="w-full border rounded-lg p-2">

                    </div>

                </div>

            @endif

            @if($source->source_type === 'csv')

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Archivo CSV
                    </label>

                    <input
                        type="file"
                        name="csv_file"
                        accept=".csv"
                        class="w-full border rounded-lg p-2">

                    @if($connection && isset($connection->config['file_path']))

                        <div class="mt-2 text-green-600 text-sm">

                            Archivo actual:
                            {{ basename($connection->config['file_path']) }}

                        </div>

                    @endif

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Separador
                    </label>

                    <input
                        type="text"
                        name="delimiter"
                        value="{{ $connection?->config['delimiter'] ?? ',' }}"
                        class="w-full border rounded-lg p-2">

                </div>

            @endif

            @if($source->source_type === 'excel')

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Archivo Excel
                    </label>

                    <input
                        type="file"
                        name="excel_file"
                        accept=".xlsx,.xls"
                        class="w-full border rounded-lg p-2">

                    @if($connection && isset($connection->config['file_path']))

                        <div class="mt-2 text-green-600 text-sm">

                            Archivo actual:
                            {{ basename($connection->config['file_path']) }}

                        </div>

                    @endif

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Hoja
                    </label>

                    <input
                        type="text"
                        name="sheet"
                        value="{{ $connection?->config['sheet'] ?? 'Sheet1' }}"
                        class="w-full border rounded-lg p-2">

                </div>

            @endif

            <div>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

                    Guardar Configuración

                </button>

            </div>

        </form>

        <hr class="my-8">

        <div class="flex flex-wrap gap-3">

            <button
                id="btnTest"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">

                Probar Conexión

            </button>

            <button
                id="btnTables"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">

                Detectar Tablas

            </button>

            <button
                id="btnFields"
                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">

                Detectar Campos

            </button>

        </div>

        <div id="result" class="mt-6"></div>

        <div id="tablesContainer" class="mt-6"></div>

        <div id="fieldsContainer" class="mt-6"></div>

    </div>

</div>
```

</div>

<script>

const token = '{{ csrf_token() }}';

async function postRequest(url)
{
    const response = await fetch(url,{
        method:'POST',
        headers:{
            'X-CSRF-TOKEN': token,
            'Accept':'application/json'
        }
    });

    return await response.json();
}

document
.getElementById('btnTest')
.addEventListener('click', async () => {

    const data = await postRequest(
        '{{ route("sources.test-connection",$source) }}'
    );

    document.getElementById('result').innerHTML =
    `<div class="p-4 rounded bg-gray-100">
        ${data.message}
    </div>`;
});

document
.getElementById('btnTables')
.addEventListener('click', async () => {

    const data = await postRequest(
        '{{ route("sources.detect-tables",$source) }}'
    );

    let html = `
        <h3 class="font-semibold mb-2">
            Tablas Encontradas
        </h3>
        <select class="border rounded p-2">
    `;

    data.tables.forEach(table => {
        html += `
            <option value="${table}">
                ${table}
            </option>
        `;
    });

    html += '</select>';

    document
        .getElementById('tablesContainer')
        .innerHTML = html;
});

document
.getElementById('btnFields')
.addEventListener('click', async () => {

    const data = await postRequest(
        '{{ route("sources.detect-fields",$source) }}'
    );

    let html = `
        <h3 class="font-semibold mb-2">
            Campos Detectados
        </h3>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
    `;

    data.fields.forEach(field => {

        html += `
            <div class="border rounded p-2 bg-gray-50">
                ${field}
            </div>
        `;
    });

    html += '</div>';

    document
        .getElementById('fieldsContainer')
        .innerHTML = html;
});

</script>

@endsection
