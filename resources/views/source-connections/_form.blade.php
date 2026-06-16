<div class="grid grid-cols-2 gap-6">

    <div>

        <label class="block mb-2">
            Fuente
        </label>

        <select
            name="source_id"
            class="w-full border rounded px-3 py-2">

            @foreach($sources as $source)

                <option
                    value="{{ $source->id }}"
                    @selected(
                        old(
                            'source_id',
                            $sourceConnection->source_id ?? null
                        ) == $source->id
                    )>

                    {{ $source->name }}

                </option>

            @endforeach

        </select>

    </div>

</div>

<div class="grid grid-cols-2 gap-6 mt-6">

    <div>

        <label>Host</label>

        <input
            type="text"
            name="host"
            class="w-full border rounded px-3 py-2"
            value="{{ old('host',$sourceConnection->host ?? '') }}">

    </div>

    <div>

        <label>Puerto</label>

        <input
            type="text"
            name="port"
            class="w-full border rounded px-3 py-2"
            value="{{ old('port',$sourceConnection->port ?? '') }}">

    </div>

</div>

<div class="grid grid-cols-2 gap-6 mt-6">

    <div>

        <label>Base de Datos</label>

        <input
            type="text"
            name="database"
            class="w-full border rounded px-3 py-2"
            value="{{ old('database',$sourceConnection->database ?? '') }}">

    </div>

    <div>

        <label>Schema</label>

        <input
            type="text"
            name="schema"
            class="w-full border rounded px-3 py-2"
            value="{{ old('schema',$sourceConnection->schema ?? 'public') }}">

    </div>

</div>

<div class="grid grid-cols-2 gap-6 mt-6">

    <div>

        <label>Usuario</label>

        <input
            type="text"
            name="username"
            class="w-full border rounded px-3 py-2"
            value="{{ old('username',$sourceConnection->username ?? '') }}">

    </div>

    <div>

        <label>Password</label>

        <input
            type="password"
            name="password"
            class="w-full border rounded px-3 py-2">

    </div>

</div>