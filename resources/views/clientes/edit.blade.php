@extends('layouts.dashboard')

@section('title', 'Editar Cliente')

@section('content')

<div class="relative max-w-2xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[400px] h-[400px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="mb-8 relative z-10">
        <h1 class="text-2xl text-white font-bold">Editar Cliente</h1>
        <p class="text-sm text-gray-400">
            Actualiza la información del cliente dentro de Dulce Rewards
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

        <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre</label>
                <input type="text" name="nombre"
                    value="{{ old('nombre', $cliente->nombre) }}"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    required>
            </div>

            <!-- TELÉFONO -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Teléfono</label>
                <input type="text" name="telefono"
                    value="{{ old('telefono', $cliente->telefono) }}"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    required>
            </div>

            <!-- FECHA NACIMIENTO -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento"
                    value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento) }}"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
            </div>

            <!-- TIPO CLIENTE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Tipo de cliente</label>
                <select name="tipo_cliente" id="tipo_cliente"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition">

                    <option value="propio" {{ old('tipo_cliente', $cliente->tipo_cliente) == 'propio' ? 'selected' : '' }}>
                        Cliente normal
                    </option>

                    <option value="empresa" {{ old('tipo_cliente', $cliente->tipo_cliente) == 'empresa' ? 'selected' : '' }}>
                        Empresa
                    </option>

                </select>
            </div>

            <!-- EMPRESA -->
            <div id="campo_empresa" class="{{ old('tipo_cliente', $cliente->tipo_cliente) == 'empresa' ? '' : 'hidden' }}">
                <label class="block text-sm text-gray-300 mb-1">Nombre de la empresa</label>
                <input type="text" name="empresa_nombre"
                    value="{{ old('empresa_nombre', $cliente->empresa_nombre) }}"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
            </div>

            <!-- SUCURSAL -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Sucursal de registro
                </label>

                <select name="sucursal_registro_id"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    required>

                    <option value="">Seleccionar sucursal</option>

                    @foreach($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}"
                            {{ old('sucursal_registro_id', $cliente->sucursal_registro_id) == $sucursal->id ? 'selected' : '' }}>
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

                <input type="checkbox" name="recibe_notificaciones" value="1"
                    {{ old('recibe_notificaciones', $cliente->recibe_notificaciones) ? 'checked' : '' }}
                    class="w-5 h-5 rounded bg-white/10 border border-white/10 text-pink-500 focus:ring-pink-500">
            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('clientes.index') }}"
                   class="px-4 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 transition">
                    Cancelar
                </a>

                <button
                    class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-lg shadow-pink-500/30 hover:scale-105">
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

</div>

<!-- SCRIPT -->
<script>
    const tipoCliente = document.getElementById('tipo_cliente');
    const campoEmpresa = document.getElementById('campo_empresa');

    function toggleEmpresa() {
        if (tipoCliente.value === 'empresa') {
            campoEmpresa.classList.remove('hidden');
        } else {
            campoEmpresa.classList.add('hidden');
        }
    }

    tipoCliente.addEventListener('change', toggleEmpresa);
    toggleEmpresa();
</script>

@endsection