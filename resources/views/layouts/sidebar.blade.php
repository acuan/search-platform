<aside
    class="w-72 bg-slate-900 text-white flex flex-col">

    <div
        class="h-16 flex items-center px-6 border-b border-slate-800">

        <h1 class="text-xl font-bold">
            Search Platform
        </h1>

    </div>

    <nav class="flex-1 overflow-y-auto p-4">

        {{-- Dashboard --}}

        <a
            href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800">

            Dashboard

        </a>

        {{-- FUENTES --}}

        <div class="mt-6">

            <h3
                class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-400">

                Fuentes de Datos

            </h3>

            <div class="space-y-1">

                <a
                    href="{{ route('sources.index') }}"
                    class="block px-4 py-2 rounded hover:bg-slate-800">
                     {{ request()->routeIs('sources.*')
                        ? 'bg-slate-800 text-white'
                        : 'hover:bg-slate-800' }}">
                    Fuentes

                </a>

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Conexiones

                </a>

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Mapeo de Campos

                </a>

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Índices

                </a>

            </div>

        </div>

        {{-- IMPORTACIONES --}}

        <div class="mt-6">

            <h3
                class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-400">

                Importaciones

            </h3>

            <div class="space-y-1">

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Importaciones

                </a>

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Lotes

                </a>

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Programadas

                </a>

            </div>

        </div>

        {{-- BUSQUEDAS --}}

        <div class="mt-6">

            <h3
                class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-400">

                Búsquedas

            </h3>

            <div class="space-y-1">

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Buscar

                </a>

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Historial

                </a>

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Guardadas

                </a>

            </div>

        </div>

        {{-- ADMINISTRACION --}}

        <div class="mt-6">

            <h3
                class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-400">

                Administración

            </h3>

            <div class="space-y-1">

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Usuarios

                </a>

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Roles

                </a>

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Permisos

                </a>

            </div>

        </div>

        {{-- SISTEMA --}}

        <div class="mt-6">

            <h3
                class="px-4 mb-2 text-xs uppercase tracking-wider text-slate-400">

                Sistema

            </h3>

            <div class="space-y-1">

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Configuración

                </a>

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Logs

                </a>

                <a
                    href="#"
                    class="block px-4 py-2 rounded hover:bg-slate-800">

                    Estado

                </a>

            </div>

        </div>

    </nav>

</aside>