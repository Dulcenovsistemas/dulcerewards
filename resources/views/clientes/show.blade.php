@extends('layouts.dashboard')

@section('title', 'Detalle del cliente')

@section('content')

<div class="max-w-7xl mx-auto">
        {{ request('jornada') }}

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl text-white font-semibold">{{ $cliente->nombre }}</h1>
            <p class="text-sm text-gray-400">Detalle del cliente</p>
        </div>

        <button
            onclick="abrirModalVenta()"
            class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg text-sm">

            + Registrar venta

        </button>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Puntos actuales</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $puntos }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Movimientos</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $movimientos->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Canjes realizados</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $canjes->count() }}
            </h3>
        </div>

    </div>

   <!-- RECOMPENSAS -->
    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 mb-6">
        <h2 class="text-white font-semibold mb-4">🎁 Recompensas disponibles</h2>

        <div class="grid md:grid-cols-3 gap-4">

            @forelse($premios as $premio)

            @php
                $esDisponible = $premioActual && $premio->id === $premioActual->id;
            @endphp

            <div class="
                border rounded-xl p-4 transition
                {{ $esDisponible 
                    ? 'bg-green-500/10 border-green-500/30 hover:bg-green-500/20' 
                    : 'bg-black/30 border-white/10 opacity-60' 
                }}
            ">

                <p class="font-medium {{ $esDisponible ? 'text-green-300' : 'text-white' }}">
                    {{ $premio->nombre }}
                </p>

                <p class="text-sm {{ $esDisponible ? 'text-green-400' : 'text-gray-400' }}">
                    {{ $premio->puntos_requeridos }} pts
                </p>

                @if($esDisponible)

                    <span class="text-xs text-green-400 font-semibold block mt-2">
                        Disponible
                    </span>

                    <button
                        onclick="abrirModalCanje(
                            {{ $premio->id }},
                            '{{ $premio->nombre }}',
                            {{ $premio->puntos_requeridos }}
                        )"
                        class="mt-3 w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">

                        Canjear

                    </button>

                @endif

            </div>

            @empty
                <p class="text-gray-500">No hay recompensas disponibles</p>
            @endforelse

        </div>
    </div>

    <!-- MOVIMIENTOS -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden mb-6">

        <div class="px-6 py-4 border-b border-white/10 text-white font-semibold">
            📊 Movimientos
        </div>

        <div class="max-h-[40vh] overflow-y-auto">
            <table class="w-full text-sm text-gray-300">

                <thead class="border-b border-white/10 text-gray-400 text-xs uppercase bg-black/20 sticky top-0">
                    <tr>
                        <th class="px-6 py-3 text-left">Descripción</th>
                        <th class="px-6 py-3 text-left">Tipo</th>
                        <th class="px-6 py-3 text-left">Fecha</th>
                        <th class="px-6 py-3 text-right">Puntos</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">

                    @forelse($movimientos as $mov)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-3">
                            {{ $mov->descripcion ?? 'Movimiento' }}
                        </td>
                        <td class="px-6 py-3 text-gray-400">
                            {{ $mov->tipo }}
                        </td>
                        <td class="px-6 py-3 text-gray-400">
                            {{ $mov->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-3 text-right font-semibold">
                            {{ $mov->puntos }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500">
                            Sin movimientos
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
        </div>
    </div>

    <!-- CANJES -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden">

        <div class="px-6 py-4 border-b border-white/10 text-white font-semibold">
            🔁 Canjes
        </div>

        <div class="max-h-[40vh] overflow-y-auto">
            <table class="w-full text-sm text-gray-300">

                <thead class="border-b border-white/10 text-gray-400 text-xs uppercase bg-black/20 sticky top-0">
                    <tr>
                        <th class="px-6 py-3 text-left">Descripción</th>
                        <th class="px-6 py-3 text-left">Fecha</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">

                    @forelse($canjes as $canje)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-3">
                            {{ $canje->descripcion ?? 'Canje realizado' }}
                        </td>
                        <td class="px-6 py-3 text-gray-400">
                            {{ $canje->created_at->format('d/m/Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center py-6 text-gray-500">
                            No hay canjes
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
        </div>
    </div>


    @php
        $maximoDisponible = max(0, 10 - $puntos);
    @endphp
    <!-- MODAL VENTA -->
    <div id="modalVenta"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center z-50">

        <div class="bg-gray-900 border border-white/10 rounded-2xl p-6 w-full max-w-md shadow-xl">

            <h2 class="text-white text-lg font-semibold mb-2">
                Registrar venta
            </h2>

            <p class="text-sm text-gray-400 mb-4">
                Cliente: {{ $cliente->nombre }}
            </p>

            <form action="{{ route('movimientos.store') }}" method="POST" class="space-y-4">
                @csrf

                <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">

        

                <input
                    type="hidden"
                    name="jornada_id"
                    value="{{ request('jornada') }}">

                <div>
                    <label class="block text-sm text-gray-300 mb-1">
                        Cantidad de pasteles
                    </label>

                    <input
                        type="number"
                        name="cantidad"
                        min="1"
                        max="{{ $maximoDisponible }}"
                        required
                        class="w-full bg-white/5 border border-white/10 text-white px-4 py-2 rounded-lg"
                        placeholder="Máximo {{ $maximoDisponible }}">

                        <p class="text-xs text-gray-400 mt-1">
                            Puede registrar hasta {{ $maximoDisponible }} punto(s).
                        </p>
                </div>

                @if(auth()->user()->is_admin)

                    <div>
                        <label class="block text-sm text-gray-300 mb-1">
                            Sucursal
                        </label>

                        <select
                            name="sucursal_id"
                            class="w-full bg-white/5 border border-white/10 text-black px-4 py-2 rounded-lg"
                            required>

                            @foreach($sucursales as $sucursal)
                                <option value="{{ $sucursal->id }}">
                                    {{ $sucursal->nombre }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                @endif

                @if($puntos < 10)

                    <button
                        onclick="abrirModalVenta()"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg text-sm">

                        + Registrar venta

                    </button>

                    @else

                    <button
                        disabled
                        class="bg-gray-600 text-gray-300 px-4 py-2 rounded-lg text-sm cursor-not-allowed">

                        Máximo de puntos alcanzado

                    </button>

                @endif

            </form>

            <button
                onclick="cerrarModalVenta()"
                class="mt-4 text-gray-400 text-sm hover:text-white">

                Cancelar

            </button>

        </div>

    </div>

    <!-- MODAL CANJE -->
    <div id="modalCanje"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center z-50">

        <div class="bg-gray-900 border border-white/10 rounded-2xl p-6 w-full max-w-md shadow-xl">

            <h2 class="text-white text-lg font-semibold mb-2">
                Canjear recompensa
            </h2>

            <p class="text-sm text-gray-400 mb-4">
                Cliente: {{ $cliente->nombre }}
            </p>

            <div class="bg-white/5 border border-white/10 rounded-xl p-4 mb-4">

                <p id="premioNombre" class="text-white font-medium"></p>

                <p id="premioPuntos" class="text-green-400 text-sm mt-1"></p>

            </div>


            <form id="formCanje" action="{{ route('canjear') }}" method="POST">
                @csrf

                <input
                    type="hidden"
                    name="cliente_id"
                    value="{{ $cliente->id }}">

                <input
                    type="hidden"
                    name="premio_id"
                    id="premio_id">

                <input
                    type="hidden"
                    name="jornada_id"
                    value="{{ request('jornada') }}">

                <button
                    class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">

                    Confirmar canje

                </button>

            </form>

            <button
                onclick="cerrarModalCanje()"
                class="mt-4 text-gray-400 text-sm hover:text-white">

                Cancelar

            </button>

        </div>

    </div>

</div>

 <!-- HOME MENU FLOTANTE -->

            <div class="fixed bottom-6 right-6 z-50">

                    <!-- OPCIONES -->
                    <div id="menuHome"
                        class="flex flex-col items-end gap-3 mb-3 opacity-0 pointer-events-none transition-all duration-300">

                        <!-- Volver -->
                        <button onclick="history.back()"
                            class="w-12 h-12 rounded-full bg-gray-700 hover:bg-gray-600 text-white shadow-lg flex items-center justify-center">

                            <i class="bi bi-arrow-left"></i>

                        </button>

                        <!-- Movimientos -->
                        <a href="{{ route('jornadas.index') }}"
                        class="w-12 h-12 rounded-full bg-green-600 hover:bg-green-700 text-white shadow-lg flex items-center justify-center">

                            <i class="bi bi-arrow-left-right"></i>

                        </a>

                        <!-- Clientes -->
                        <a href="{{ route('clientes.index') }}"
                        class="w-12 h-12 rounded-full bg-pink-600 hover:bg-pink-700 text-white shadow-lg flex items-center justify-center">

                            <i class="bi bi-people-fill"></i>

                        </a>

                        <!-- Inicio -->
                        <a href="{{ route('dashboard') }}"
                        class="w-12 h-12 rounded-full bg-blue-600 hover:bg-blue-700 text-white shadow-lg flex items-center justify-center">

                            <i class="bi bi-house-fill"></i>

                        </a>

                    </div>

                    <!-- BOTON PRINCIPAL -->
                    <button id="btnMenu"
                        onclick="toggleMenu()"
                        class="bg-blue-600 hover:bg-blue-700 text-white w-14 h-14 rounded-full shadow-xl flex items-center justify-center transition">

                        <i id="iconMenu" class="bi bi-list text-[22px]"></i>

                    </button>

            </div>

<script>

    function toggleMenu() {

    const menu = document.getElementById('menuHome');
    const icon = document.getElementById('iconMenu');

    if(menu.classList.contains('opacity-0')) {

        menu.classList.remove('opacity-0');
        menu.classList.remove('pointer-events-none');

        icon.classList.remove('bi-list');
        icon.classList.add('bi-x-lg');

    } else {

        menu.classList.add('opacity-0');
        menu.classList.add('pointer-events-none');

        icon.classList.remove('bi-x-lg');
        icon.classList.add('bi-list');

    }

}


// ==========================
// MODAL VENTA
// ==========================

function abrirModalVenta() {

    document
        .getElementById('modalVenta')
        .classList
        .remove('hidden');

}

function cerrarModalVenta() {

    document
        .getElementById('modalVenta')
        .classList
        .add('hidden');

}

// ==========================
// MODAL CANJE
// ==========================

function abrirModalCanje(id, nombre, puntos) {

    document
        .getElementById('premioNombre')
        .innerText = nombre;

    document
        .getElementById('premioPuntos')
        .innerText = puntos + ' puntos';

    // 👇 ESTA ES LA QUE FALTA
    document
        .getElementById('premio_id')
        .value = id;

    document
        .getElementById('modalCanje')
        .classList
        .remove('hidden');

}

function cerrarModalCanje() {

    document
        .getElementById('modalCanje')
        .classList
        .add('hidden');

}

// ==========================
// CERRAR CON ESC
// ==========================

document.addEventListener('keydown', function(e){

    if(e.key === 'Escape') {

        cerrarModalVenta();
        cerrarModalCanje();

    }

});

</script>

@endsection