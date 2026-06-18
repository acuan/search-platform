<aside class="w-64 bg-slate-900 text-white min-h-screen">

    {{-- Logo --}}
    <div class="h-16 flex items-center px-6 border-b border-slate-800">

        <h1 class="text-xl font-bold">
            Search Platform
        </h1>

    </div>

    {{-- Navegación --}}
    <nav class="p-4 space-y-1">

        {{-- Dashboard --}}
        <a
            href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

            <span>📊</span>

            <span>Dashboard</span>

        </a>

        {{-- Fuentes --}}
        <a
            href="{{ route('sources.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

            <span>🗄️</span>

            <span>Fuentes</span>

        </a>

        {{-- Importaciones --}}
        <a
            href="{{ route('imports.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

            <span>📥</span>

            <span>Importaciones</span>

        </a>
        <a
            href="{{ route(
                'sources.mappings.index',
                $source
            ) }}"
            class="block px-4 py-2 rounded hover:bg-slate-800">

            Mapeo de Campos

        </a>
        {{-- Búsquedas --}}
        <a
            href="{{ route('search.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

            <span>🔎</span>

            <span>Buscador</span>

        </a>

        {{-- Historial --}}
        <a
            href="{{ route('search-logs.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

            <span>📜</span>

            <span>Historial</span>

        </a>

        {{-- Búsquedas Guardadas --}}
        <a
            href="{{ route('saved-searches.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

            <span>⭐</span>

            <span>Búsquedas Guardadas</span>

        </a>

        <div class="border-t border-slate-800 my-4"></div>

        {{-- Administración --}}
        <div class="px-4 py-2 text-xs uppercase tracking-wider text-slate-400">

            Administración

        </div>

        {{-- Usuarios --}}
        <a
            href="{{ route('users.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

            <span>👥</span>

            <span>Usuarios</span>

        </a>

        {{-- Roles --}}
        <a
            href="{{ route('roles.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

            <span>🛡️</span>

            <span>Roles</span>

        </a>

        {{-- Permisos --}}
        <a
            href="{{ route('permissions.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">

            <span>🔐</span>

            <span>Permisos</span>

        </a>

    </nav>

    {{-- Usuario --}}
    <div class="absolute bottom-0 w-64 border-t border-slate-800 p-4">

        <div class="text-sm text-slate-400">
            Conectado como
        </div>

        <div class="absolute bottom-0 w-64 border-t border-slate-800 p-4">

    <div class="text-sm text-slate-400">
        Sistema
    </div>

    <div class="font-medium">
        Administrador
    </div>

</div>

    </div>

</aside>