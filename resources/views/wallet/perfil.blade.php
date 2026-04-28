@extends('layouts.wallet')

@section('content')

<div class="min-h-screen relative px-4 pb-24">
       <!-- 🔙 BOTÓN VOLVER -->
    <button onclick="goBack()" class="
        w-10 h-10 flex items-center justify-center
        rounded-full
        bg-white/5
        border border-white/10
        hover:bg-white/10
        transition
    ">
        <i class="bi bi-arrow-left text-white text-lg"></i>
    </button>


    <!-- 👤 HEADER -->
    <div class="flex items-center justify-between mb-6 mt-4">

        <div>
            <p class="text-xs text-gray-400">Perfil</p>
            <h1 class="text-lg font-semibold text-white">
                {{ $cliente->nombre }}
            </h1>
        </div>

    </div>

    <!-- 💳 TARJETA PERFIL -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-5">

        <!-- Avatar -->
        <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 rounded-full bg-[#d29ba8]/30 flex items-center justify-center text-white text-xl font-bold">
                {{ strtoupper(substr($cliente->nombre, 0, 1)) }}
            </div>

            <div>
                <p class="text-white font-semibold">{{ $cliente->nombre }}</p>
                <p class="text-xs text-gray-400">Cliente</p>
            </div>
        </div>

        <!-- Datos -->
        <div class="space-y-4">

            <!-- Teléfono -->
            <div class="flex justify-between items-center">
                <span class="text-gray-400 text-sm">Teléfono</span>
                <span class="text-white text-sm font-medium">
                    {{ $cliente->telefono ?? '—' }}
                </span>
            </div>

            <!-- Ciudad -->
            <div class="flex justify-between items-center">
                <span class="text-gray-400 text-sm">Ciudad</span>
                <span class="text-white text-sm font-medium">
                    {{ optional($cliente->sucursal)->ciudad ?? '—' }}
                </span>
            </div>

            <!-- Fecha de nacimiento -->
            <div class="flex justify-between items-center">
                <span class="text-gray-400 text-sm">Fecha de nacimiento</span>
                <span class="text-white text-sm font-medium">
                    {{ $cliente->fecha_nacimiento ?? '—' }}
                </span>
            </div>

        </div>

    </div>

</div>

@endsection