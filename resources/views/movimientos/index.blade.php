@extends('layouts.dashboard')

@section('title', 'Movimientos')

@section('content')

<div class="relative max-w-7xl mx-auto py-6 px-4">

```
    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-white">
                Movimientos · Dulce Rewards
            </h1>
            <p class="text-sm text-gray-400">
                Control de puntos en tiempo real
            </p>
        </div>

        <button onclick="abrirModal()"
            class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2.5 rounded-xl shadow-lg">
            + Registrar compra
        </button>
    </div>

    <!-- KPIs -->
    <div class="grid grid-cols-3 gap-4 mb-6">

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Movimientos</p>
            <h3 class="text-white text-3xl font-bold">
                {{ $movimientos->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Puntos</p>
            <h3 class="text-green-400 text-3xl font-bold">
                {{ $movimientos->where('tipo','acumulado')->sum('puntos') }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Canjes</p>
            <h3 class="text-red-400 text-3xl font-bold">
                {{ $movimientos->where('tipo','canjeado')->count() }}
            </h3>
        </div>

    </div>

    <!-- GRID POS -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- CLIENTES -->
        <div class="bg-white/5 border border-white/10 rounded-2xl">

            <div class="p-4 border-b border-white/10">
                <input id="buscadorCliente"
                    placeholder="Buscar teléfono..."
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2 rounded-xl">
            </div>

            <div class="max-h-[65vh] overflow-y-auto">

                @foreach($clientes as $cliente)
                <div class="cliente-item flex justify-between items-center px-4 py-3 border-b border-white/5 cursor-pointer hover:bg-white/5"
                data-telefono="{{ $cliente['telefono'] }}"
                onclick="seleccionarCliente(this, {{ $cliente['id'] }}, '{{ $cliente['nombre'] }}')">

                <!-- INFO -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-pink-500/20 rounded-full flex items-center justify-center text-pink-300">
                        {{ strtoupper(substr($cliente['nombre'],0,2)) }}
                    </div>

                    <div>
                        <p class="text-white text-sm">{{ $cliente['nombre'] }}</p>
                        <p class="text-xs text-gray-400">{{ $cliente['telefono'] }}</p>
                    </div>
                </div>

                <!-- DERECHA -->
                <div class="flex items-center gap-3">

                    <span class="text-green-400 text-sm font-semibold">
                        {{ $cliente['puntos'] }}
                    </span>

                    <!-- BOTONES SIEMPRE VISIBLES -->
                    <div class="flex gap-2">

                        <a href="{{ route('clientes.show', $cliente['id']) }}"
                            class="text-gray-400 hover:text-white text-sm transition"
                            onclick="event.stopPropagation()">
                            <i class="bi bi-eye-fill"></i>
                        </a>

                        <button onclick="event.stopPropagation(); abrirModalConCliente({{ $cliente['id'] }}, '{{ $cliente['nombre'] }}')"
                            class="text-green-400 hover:text-green-300 text-sm transition">
                            <i class="bi bi-plus-circle-fill"></i>
                        </button>

                        @if($cliente['puede_canjear'])
                        <button onclick="event.stopPropagation(); abrirScannerCanje({{ $cliente['id'] }})"
                            class="text-pink-400 hover:text-pink-300 text-sm transition">
                            <i class="bi bi-gift"></i>
                        </button>
                        @endif

                    </div>

                </div>

            </div>
                @endforeach

            </div>

        </div>

        <!-- DERECHA -->
        <div class="lg:col-span-2 space-y-4">

            <!-- PANEL POS -->
            <div id="panelAccion"
                class="hidden bg-white/5 border border-white/10 rounded-2xl p-4">

                <div class="flex justify-between items-center">

                    <div class="flex items-center gap-3">
                        <div id="avatarCliente"
                            class="w-10 h-10 bg-pink-500/20 rounded-full flex items-center justify-center text-pink-300">
                            --
                        </div>

                        <div>
                            <p id="nombreCliente" class="text-white font-medium"></p>
                            <p class="text-xs text-gray-400">Cliente activo</p>
                        </div>
                    </div>

                    <div class="flex gap-2">

                        <input id="cantidadRapida" type="number" value="1"
                            class="w-20 bg-white/10 border border-white/10 text-white px-3 py-2 rounded-lg">

                        <button onclick="registrarRapido()"
                            class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
                            + Puntos
                        </button>

                        <button onclick="abrirScannerCanje(clienteActivoId)"
                            class="bg-white/10 px-3 py-2 rounded-lg text-white">
                            🎁
                        </button>

                    </div>

                </div>

            </div>

            <!-- HISTORIAL -->
            <div class="bg-white/5 border border-white/10 rounded-2xl">

                <div class="p-4 border-b border-white/10">
                    <h2 class="text-white font-semibold">Historial</h2>
                </div>

                <div class="max-h-[60vh] overflow-y-auto">

                    @foreach($movimientos as $mov)
                    <div class="flex justify-between px-4 py-3 border-b border-white/5">

                        <div>
                            <p class="text-white text-sm">{{ $mov->cliente->nombre }}</p>
                            <p class="text-xs text-gray-400">{{ $mov->sucursal->nombre }}</p>
                        </div>

                        <div class="text-right">
                            <p class="{{ $mov->tipo == 'acumulado' ? 'text-green-400' : 'text-red-400' }}">
                                {{ $mov->tipo == 'acumulado' ? '+' : '-' }}{{ $mov->puntos }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ $mov->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                    </div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>
    ```

        <!-- LOGOUT -->
            <button
                onclick="event.preventDefault(); if(confirm('¿Cerrar sesión?')) document.getElementById('logout-form').submit();"
                class="fixed bottom-6 right-24 bg-red-600 hover:bg-red-700 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-xl transition">

                <i class="bi bi-box-arrow-right text-[20px] leading-none"></i>

            </button>

            <!-- HOME -->
            <a href="{{ route('dashboard') }}"
            class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-xl transition">

                <i class="bi bi-house text-[20px] leading-none"></i>

            </a>

    </div>

    <!-- MODAL -->

<div id="modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center z-50">

    <div class="bg-gray-900 border border-white/10 rounded-2xl p-6 w-full max-w-md shadow-xl">

        <!-- TITULO -->
        <h2 class="text-white text-lg font-semibold mb-2">
            Registrar compra
        </h2>

        <p class="text-sm text-gray-400 mb-4">
            ¿Cómo deseas identificar al cliente?
        </p>

        <!-- NOMBRE CLIENTE (modo tabla) -->
        <p id="clienteNombre" class="text-white text-sm mb-3 hidden"></p>

        <!-- OPCIONES (solo cuando NO hay cliente seleccionado) -->
        <div id="opcionesIdentificacion" class="grid grid-cols-1 gap-4">

            <!-- ESCANEAR -->
            <button onclick="iniciarScanner()"
                class="flex items-center gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition border border-white/10">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-500/20 text-blue-400 text-xl">
                    📷
                </div>
                <div class="text-left">
                    <p class="text-white font-medium">Escanear QR</p>
                    <p class="text-xs text-gray-400">Usar cámara del dispositivo</p>
                </div>
            </button>

            <div id="qr-reader" class="mt-4 hidden w-full" style="min-height: 250px;"></div>

            <!-- TELÉFONO -->
            <button onclick="mostrarTelefono()"
                class="flex items-center gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition border border-white/10">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-green-500/20 text-green-400 text-xl">
                    📱
                </div>
                <div class="text-left">
                    <p class="text-white font-medium">Ingresar teléfono</p>
                    <p class="text-xs text-gray-400">Buscar cliente manualmente</p>
                </div>
            </button>

        </div>

        <!-- FORM -->
        <div id="formTelefono" class="mt-6 hidden">

            <form action="{{ route('movimientos.store') }}" method="POST" class="space-y-3">
                @csrf

                <!-- 🔥 cliente seleccionado (modo tabla) -->
                <input type="hidden" name="cliente_id" id="clienteSeleccionado">

                <!-- 🔥 teléfono (modo manual) -->
                <div id="inputTelefono">
                    <input type="text" name="telefono"
                        class="w-full bg-white/5 border border-white/10 text-white px-4 py-2 rounded-lg"
                        placeholder="52..." value="52">
                </div>

                <!-- cantidad -->
                <input type="number" name="cantidad"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2 rounded-lg"
                    placeholder="Número de pasteles" required>

                @if(auth()->user()->is_admin)
                <select name="sucursal_id"
                    class="w-full bg-white/5 border border-white/10 text-black px-4 py-2 rounded-lg mb-3"
                    required>

                    <option value="">Seleccionar sucursal</option>

                    @foreach($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}">
                            {{ $sucursal->nombre }}
                        </option>
                    @endforeach

                </select>
                @endif

                <p class="text-xs text-gray-400">
                    ⚠️ Los pasteles minis no cuentan
                </p>

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">
                    Confirmar
                </button>

            </form>

        </div>

        <!-- CERRAR -->
        <button onclick="cerrarModal()" class="mt-6 text-gray-400 text-sm hover:text-white">
            Cancelar
        </button>

    </div>
</div>

<div id="modalCanje" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center z-50">

        <div class="bg-gray-900 border border-white/10 rounded-2xl p-6 w-full max-w-md shadow-xl">

            <h2 class="text-white text-lg font-semibold mb-4">
                Validar cliente para canje
            </h2>

            <p class="text-sm text-gray-400 mb-4">
                Escanea el código QR del cliente
            </p>

            <div id="qr-reader-canje" class="w-full" style="min-height:250px;"></div>

            <button onclick="cerrarModalCanje()" class="mt-4 text-gray-400 text-sm hover:text-white">
                Cancelar
            </button>

        </div>

    </div>

<script>

// =========================
// MODAL
// =========================

function abrirModal() {
    const modal = document.getElementById('modal');
    if (!modal) return console.error('Modal no encontrado');

    modal.classList.remove('hidden');

    document.getElementById('opcionesIdentificacion').style.display = '';
    document.getElementById('inputTelefono').style.display = '';
    document.getElementById('formTelefono').classList.add('hidden');

    document.getElementById('clienteNombre').classList.add('hidden');
    document.getElementById('clienteSeleccionado').value = '';
}

function cerrarModal() {
    const modal = document.getElementById('modal');
    if (!modal) return;

    modal.classList.add('hidden');
}

function abrirModalConCliente(id, nombre) {
    abrirModal();

    document.getElementById('clienteSeleccionado').value = id;

    const nombreUI = document.getElementById('clienteNombre');
    nombreUI.innerText = "Cliente: " + nombre;
    nombreUI.classList.remove('hidden');

    document.getElementById('opcionesIdentificacion').style.display = 'none';
    document.getElementById('inputTelefono').style.display = 'none';

    document.getElementById('formTelefono').classList.remove('hidden');
}

function mostrarTelefono() {
    document.getElementById('formTelefono').classList.remove('hidden');
}

// =========================
// MODAL CANJE
// =========================

function abrirScannerCanje(clienteId) {
    const modal = document.getElementById('modalCanje');
    if (!modal) return console.error('ModalCanje no encontrado');

    modal.classList.remove('hidden');
}

function cerrarModalCanje() {
    const modal = document.getElementById('modalCanje');
    if (!modal) return;

    modal.classList.add('hidden');
}


const buscador = document.getElementById('buscadorCliente');

if (buscador) {
    buscador.addEventListener('input', function () {

        let valor = this.value.toLowerCase();

        let clientes = document.querySelectorAll('.cliente-item');

        clientes.forEach(cliente => {
            let telefono = (cliente.dataset.telefono || '').toLowerCase();

            if (telefono.includes(valor)) {
                cliente.style.display = '';
            } else {
                cliente.style.display = 'none';
            }
        });

    });
}
</script>

@endsection