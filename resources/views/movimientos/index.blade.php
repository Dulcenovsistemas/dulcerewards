@extends('layouts.dashboard')

@section('title', 'Movimientos')

@section('content')

<div class="max-w-7xl mx-auto py-6 px-4">

    @if(session('error'))
    <div class="mb-4 bg-red-500/20 border border-red-400/30 text-red-300 px-4 py-3 rounded-xl text-sm">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="mb-4 bg-green-500/20 border border-green-400/30 text-green-300 px-4 py-3 rounded-xl text-sm">
        {{ session('success') }}
    </div>
@endif

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl text-white font-semibold">Movimientos</h1>
            <p class="text-sm text-gray-400">Historial de puntos de clientes</p>
        </div>

        <div class="flex gap-3">
            <!-- REGISTRAR -->
            <button onclick="abrirModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                + Registrar compra
            </button>
        </div>
    </div>

    <!-- BANNER -->
    <div class="mb-6 bg-gradient-to-r from-blue-600/20 to-blue-800/20 border border-blue-500/20 p-4 rounded-xl">
        <p class="text-sm text-blue-300">
            Registra compras y consulta el historial de puntos de tus clientes.
        </p>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Movimientos totales</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $movimientos->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Puntos acumulados</p>
            <h3 class="text-green-400 text-2xl font-semibold">
                {{ $movimientos->where('tipo','acumulado')->sum('puntos') }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Canjes realizados</p>
            <h3 class="text-red-400 text-2xl font-semibold">
                {{ $movimientos->where('tipo','canjeado')->count() }}
            </h3>
        </div>

    </div>

    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl mb-6">

    <div class="p-4 border-b border-white/10">
        <h2 class="text-white font-semibold">Clientes</h2>
    </div>

        <div class="max-h-[40vh] overflow-y-auto">

            <table class="w-full text-sm text-gray-300">

                <thead class="text-gray-400 text-xs uppercase bg-black/20">
                    <tr>
                        <th class="px-6 py-4 text-left">Cliente</th>
                        <th class="px-6 py-4 text-left">Ciudad</th>
                        <th class="px-6 py-4 text-left">Puntos</th>
                        <th class="px-6 py-4 text-left">Recompensa</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">

                    @foreach($clientes as $cliente)
                    <tr class="hover:bg-white/5">

                        <td class="px-6 py-4">
                            {{ $cliente['nombre'] }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $cliente['ciudad'] ?? '—' }}
                        </td>

                        <td class="px-6 py-4 text-green-400 font-semibold">
                            {{ $cliente['puntos'] }}
                        </td>

                        <td class="px-6 py-4">
                            @if($cliente['puede_canjear'])
                                <span class="bg-green-500/20 text-green-400 px-3 py-1 text-xs rounded-full">
                                    Disponible
                                </span>
                            @else
                                <span class="bg-gray-500/20 text-gray-400 px-3 py-1 text-xs rounded-full">
                                    No disponible
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-right flex justify-end gap-3">

                            <a href="{{ route('clientes.show', $cliente['id']) }}"
                                class="text-blue-400 hover:text-blue-300 text-sm">
                                Ver
                            </a>

                            @if($cliente['puede_canjear'])
                               <form action="{{ route('canjear') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="cliente_id" value="{{ $cliente['id'] }}">
                                    <input type="hidden" name="sucursal_id" value="{{ auth()->user()->sucursal_id }}">

                                    <button type="button"
                                        onclick="abrirScannerCanje({{ $cliente['id'] }})"
                                        class="text-pink-400 hover:text-pink-300 text-sm">
                                        Canjear
                                    </button>
                                </form>
                            @endif

                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <!-- TABLA -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden">

        <div class="p-4 border-b border-white/10">
            <h2 class="text-white font-semibold">Movimientos</h2>
        </div>

        <div class="max-h-[60vh] overflow-y-auto">

            <table class="w-full text-sm text-gray-300">

                <!-- HEADER -->
                <thead class="border-b border-white/10 text-gray-400 text-xs uppercase bg-black/20 backdrop-blur sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-4 text-left">Cliente</th>
                        <th class="px-6 py-4 text-left">Sucursal</th>
                        <th class="px-6 py-4 text-left">Puntos</th>
                        <th class="px-6 py-4 text-left">Tipo</th>
                        <th class="px-6 py-4 text-left">Fecha</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-white/5">

                    @forelse($movimientos as $mov)
                    <tr class="hover:bg-white/5 transition">

                        <!-- CLIENTE -->
                        <td class="px-6 py-4 flex items-center gap-3">

                            <div class="w-8 h-8 rounded-full bg-purple-500/20 flex items-center justify-center text-xs text-purple-300">
                                {{ strtoupper(substr($mov->cliente->nombre, 0, 2)) }}
                            </div>

                            <span class="text-white font-medium">
                                {{ $mov->cliente->nombre }}
                            </span>

                        </td>

                        <!-- SUCURSAL -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs bg-white/10 text-gray-300 rounded-full">
                                {{ $mov->sucursal->nombre }}
                            </span>
                        </td>

                        <!-- PUNTOS -->
                        <td class="px-6 py-4">
                            <span class="{{ $mov->tipo == 'acumulado' ? 'text-green-400' : 'text-red-400' }}">
                                {{ $mov->tipo == 'acumulado' ? '+' : '-' }}{{ $mov->puntos }}
                            </span>
                        </td>

                        <!-- TIPO -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full
                                {{ $mov->tipo == 'acumulado'
                                    ? 'bg-green-500/20 text-green-400'
                                    : 'bg-red-500/20 text-red-400' }}">
                                {{ ucfirst($mov->tipo) }}
                            </span>
                        </td>

                        <!-- FECHA -->
                        <td class="px-6 py-4 text-gray-400">
                            {{ $mov->created_at->format('d/m/Y H:i') }}
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            No hay movimientos registrados
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
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
<div id="modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50">

    <div class="bg-gray-900 border border-white/10 rounded-2xl p-6 w-full max-w-md shadow-xl">

        <!-- TITULO -->
        <h2 class="text-white text-lg font-semibold mb-2">
            Registrar compra
        </h2>

        <p class="text-sm text-gray-400 mb-6">
            ¿Cómo deseas identificar al cliente?
        </p>

        <!-- OPCIONES -->
        <div class="grid grid-cols-1 gap-4">

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

        <!-- FORM TELEFONO (OCULTO) -->
        <div id="formTelefono" class="mt-6 hidden">

            <form action="{{ route('movimientos.store') }}" method="POST" class="space-y-3">
                @csrf

                <input type="text" name="telefono"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2 rounded-lg"
                    placeholder="Teléfono" required>

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

<div id="modalCanje" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50">

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

@endsection