@extends('layouts.dashboard')

@section('title', 'Detalle del cliente')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl text-white font-semibold">{{ $cliente->nombre }}</h1>
            <p class="text-sm text-gray-400">Detalle del cliente</p>
        </div>

        <a href="{{ route('movimientos.index') }}"
           class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
            ← Volver
        </a>
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
                <span class="text-xs text-green-400 font-semibold">
                    Disponible
                </span>
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

</div>

@endsection