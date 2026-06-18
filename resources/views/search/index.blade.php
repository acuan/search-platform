@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <div class="bg-white rounded-lg shadow">

        <div class="p-6 border-b">

            <h1 class="text-2xl font-bold">

                Buscador Global

            </h1>

        </div>

        <div class="p-6">

            <form
                method="POST"
                action="{{ route('search.execute') }}"
                class="flex gap-3">

                @csrf

                <input
                    type="text"
                    name="query"
                    value="{{ $query ?? '' }}"
                    class="flex-1 border rounded p-3">

                <button
                    class="bg-blue-600 text-white px-6 rounded">

                    Buscar

                </button>

            </form>

        </div>

    </div>

    @if(isset($results))

        <div class="mt-6 bg-white rounded-lg shadow">

            <div class="p-6">

                <h2 class="font-bold mb-4">

                    Resultados

                </h2>

                @foreach($results as $result)

                    <div
                        class="border-b py-4">

                        <div class="font-semibold">

                            {{ $result['_source']['source_name'] }}

                        </div>

                        <pre class="text-sm mt-2 overflow-auto">{{ json_encode($result['_source']['normalized_data'], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>

                    </div>

                @endforeach

            </div>

        </div>

    @endif

</div>

@endsection