@extends('layouts.dashboard')

@section('title', 'Nuevo Cliente')

@section('content')

<div class="relative max-w-2xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[400px] h-[400px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="mb-8 relative z-10">
        <h1 class="text-2xl text-white font-bold">Nuevo Cliente</h1>
        <p class="text-sm text-gray-400">
            Registra un cliente para comenzar a acumular recompensas
        </p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl relative z-10">

        <!-- ERRORES -->
        @if ($errors->any())
            <div class="mb-4 bg-red-500/10 border border-red-500/20 text-red-400 p-3 rounded-lg text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clientes.store') }}" method="POST" class="space-y-6">
            @csrf

            <input type="hidden"
            name="jornada_id"
            value="{{ request('jornada') }}">
            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre</label>
                <input type="text" name="nombre" autofocus
                    class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="Ej. Juan Pérez" required>
            </div>

            <!-- TELÉFONO -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Teléfono</label>
                <input type="text" name="telefono"
                    class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="Ej. 526561234567"
                    value="52"
                    required>

                <p class="text-xs text-gray-500 mt-1">
                    Incluye lada del país (ej. 52 para México o 1 para USA).
                </p>
            </div>

            <!-- FECHA NACIMIENTO -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
            </div>

            <!-- TIPO CLIENTE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Tipo de cliente</label>
                <select name="tipo_cliente" id="tipo_cliente"
                    class="w-full bg-white/10 border border-white/10 text-black px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition">

                    <option value="propio">Cliente normal</option>
                    <option value="empresa">Empresa</option>

                </select>
            </div>

            <!-- EMPRESA -->
            <div id="campo_empresa" class="hidden">
                <label class="block text-sm text-gray-300 mb-1">Nombre de la empresa</label>
                <input type="text" name="empresa_nombre"
                    class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="Ej. Dulce Noviembre">
            </div>

            <!-- SUCURSAL -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Sucursal de registro
                </label>

                <select name="sucursal_registro_id"
                    class="w-full bg-white/10 border border-white/10 text-black px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    required>

                    <option value="">Seleccionar sucursal</option>

                    @foreach($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}">
                            {{ $sucursal->nombre }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- NOTIFICACIONES -->
            <div class="flex items-center justify-between bg-white/5 border border-white/10 rounded-xl px-4 py-3">

                <div>
                    <p class="text-sm text-white font-medium">Recibir notificaciones</p>
                    <p class="text-xs text-gray-400">
                        Permite enviar promociones y recompensas al cliente
                    </p>
                </div>

                <input type="checkbox" name="recibe_notificaciones" value="1" checked
                    class="w-5 h-5 rounded bg-white/10 border border-white/10 text-pink-500 focus:ring-pink-500">
            </div>

            <!-- PRIMEROS PUNTOS -->
            <div class="border border-pink-500/20 bg-pink-500/5 rounded-xl p-4">

                <div class="flex items-center gap-2 mb-3">
                    <input type="checkbox"
                        id="registrar_puntos"
                        name="registrar_puntos"
                        value="1"
                        class="w-5 h-5">

                    <label for="registrar_puntos"
                        class="text-sm text-white font-medium">
                        Registrar primeros puntos
                    </label>
                </div>

                <div id="contenedor_puntos" class="hidden space-y-4">

                    <div>
                        <label class="block text-sm text-gray-300 mb-1">
                            Puntos iniciales
                        </label>

                        <input type="number"
                            name="puntos_iniciales"
                            min="1"
                            class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl"
                            placeholder="Ej. 10">
                    </div>

                </div>

            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('clientes.index') }}"
                   class="px-4 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 transition">
                    Cancelar
                </a>

                <button
                    class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-lg shadow-pink-500/30 hover:scale-105">
                    Crear cliente
                </button>

            </div>

        </form>

    </div>

</div>


@if(session('cliente_creado'))

@php
$clienteModal = \App\Models\Cliente::find(session('cliente_id'));
@endphp
<div id="clienteModal"
     class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50">

    <div class="bg-slate-900 border border-white/10 rounded-3xl p-8 max-w-md w-full mx-4">

        <div class="text-center">

            <div class="text-6xl mb-4">
                🎉
            </div>

            <h2 class="text-2xl font-bold text-white mb-2">
                Cliente registrado
            </h2>

            <p class="text-gray-400 mb-6">
                {{ session('cliente_nombre') }} fue registrado correctamente.
            </p>

            <div class="space-y-3">

                @if($clienteModal)

                <a href="https://wa.me/{{ $clienteModal->telefono }}?text=Hola%20{{ urlencode($clienteModal->nombre) }}%20👋%0ATe%20compartimos%20tu%20tarjeta%20digital:%0A{{ route('wallet.show', $clienteModal->qr_token) }}"
                target="_blank"
                class="block w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl font-medium transition">
                    📲 Enviar tarjeta
                </a>

                @endif

                <a href="{{ route('jornadas.index', session('jornada_id')) }}"
                   class="block w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl font-medium transition">
                    🎂 Volver a jornada
                </a>

                <a href="{{ route('clientes.index') }}"
                   class="block w-full bg-white/10 hover:bg-white/20 text-white py-3 rounded-xl font-medium transition">
                    👥 Ver clientes
                </a>

                <button onclick="cerrarModal()"
                        class="w-full border border-white/10 text-gray-300 py-3 rounded-xl hover:bg-white/10 transition">
                    ➕ Registrar otro cliente
                </button>

            </div>

        </div>

    </div>

</div>

@endif

<!-- SCRIPT -->
<script>
    const tipoCliente = document.getElementById('tipo_cliente');
    const campoEmpresa = document.getElementById('campo_empresa');

    const registrarPuntos = document.getElementById('registrar_puntos');
    const contenedorPuntos = document.getElementById('contenedor_puntos');

    function toggleEmpresa() {
        if (tipoCliente.value === 'empresa') {
            campoEmpresa.classList.remove('hidden');
        } else {
            campoEmpresa.classList.add('hidden');
        }
    }

    function togglePuntos() {
        if (registrarPuntos.checked) {
            contenedorPuntos.classList.remove('hidden');
        } else {
            contenedorPuntos.classList.add('hidden');
        }
    }

    tipoCliente.addEventListener('change', toggleEmpresa);
    registrarPuntos.addEventListener('change', togglePuntos);

    toggleEmpresa();
    togglePuntos();

    function cerrarModal() {
        document.getElementById('clienteModal').remove();
    }
</script>

@endsection