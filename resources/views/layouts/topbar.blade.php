<header
    class="bg-white border-b h-16 flex items-center justify-between px-6">

    <div>

        <h2 class="font-semibold text-lg">
            Plataforma de Búsqueda
        </h2>

    </div>

    <div class="flex items-center gap-4">

        <span class="text-sm text-gray-600">

            {{ auth()->user()->name ?? 'Administrador' }}

        </span>
{{--
        <form
            method="POST"
            action="{{ route('logout') }}">

            @csrf

            <button
                class="text-red-600">

                Salir

            </button>

        </form>
--}}
    </div>

</header>