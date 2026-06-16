@extends('layouts.app')

@section('content')

<div class="max-w-4xl">

    <div class="bg-white rounded-xl shadow p-6">

        <form
            method="POST"
            action="{{ route('source-connections.store') }}">

            @csrf

            @include('source-connections._form')

            <button
                class="mt-6 px-5 py-2 bg-indigo-600 text-white rounded">

                Guardar

            </button>

        </form>

    </div>

</div>

@endsection