@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-xl shadow">

        <div class="border-b p-6">

            <h2 class="text-xl font-bold">
                Nueva Fuente
            </h2>

        </div>

        <form
            action="{{ route('sources.update',$source) }}"
            method="POST"
            class="p-6">

            @csrf
            @method('PUT')
            @include('sources._form')

            <div class="mt-8 flex gap-3">

                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">

                    Guardar

                </button>

                <a
                    href="{{ route('sources.index') }}"
                    class="bg-gray-300 px-5 py-2 rounded-lg">

                    Cancelar

                </a>

            </div>

        </form>

    </div>

</div>

@endsection