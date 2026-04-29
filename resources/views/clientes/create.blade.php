@extends('layouts.dashboard')

@section('title', 'Nuevo Cliente')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-xl text-white font-semibold">Nuevo Cliente</h1>
        <p class="text-sm text-gray-400">Registra un cliente en el sistema</p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">

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

        <form action="{{ route('clientes.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre</label>
                <input type="text" name="nombre" autofocus
                    class="w-full bg-white/5 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    placeholder="Ej. Juan Pérez" required>
            </div>

            <!-- TELÉFONO -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Teléfono</label>
                <input type="text" name="telefono"
                    class="w-full bg-white/5 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    placeholder="Ej. 526561234567" value="52" required>
            </div>

            <!-- FECHA NACIMIENTO -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

            <!-- TIPO CLIENTE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Tipo de cliente</label>
                <select name="tipo_cliente" id="tipo_cliente"
                    class="w-full bg-white/5 border border-white/10 text-black px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

                    <option value="propio">Cliente normal</option>
                    <option value="empresa">Empresa</option>
                </select>
            </div>

            <!-- EMPRESA (CONDICIONAL) -->
            <div id="campo_empresa" class="hidden">
                <label class="block text-sm text-gray-300 mb-1">Nombre de la empresa</label>
                <input type="text" name="empresa_nombre"
                    class="w-full bg-white/5 border border-white/10 text-black placeholder-gray-400 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    placeholder="Ej. Dulce Noviembre">
            </div>

            <!-- SUCURSAL -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Sucursal de registro
                </label>

                <select name="sucursal_registro_id"
                    class="w-full bg-white/5 border border-white/10 text-black px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
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
            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="recibe_notificaciones" value="1" checked
                    class="rounded bg-white/5 border border-white/10 text-blue-500 focus:ring-blue-500">
                <label class="text-sm text-gray-300">
                    Recibir notificaciones
                </label>
            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('clientes.index') }}"
                   class="px-4 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 transition">
                    Cancelar
                </a>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition shadow">
                    Guardar
                </button>

            </div>

        </form>

    </div>

</div>

<!-- SCRIPT -->
<script>
    const tipoCliente = document.getElementById('tipo_cliente');
    const campoEmpresa = document.getElementById('campo_empresa');

    tipoCliente.addEventListener('change', function () {
        if (this.value === 'empresa') {
            campoEmpresa.classList.remove('hidden');
        } else {
            campoEmpresa.classList.add('hidden');
        }
    });
</script>

@endsection