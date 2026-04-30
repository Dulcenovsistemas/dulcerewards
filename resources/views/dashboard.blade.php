@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<div class="relative max-w-6xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- Header -->
    <div class="flex justify-between items-center mb-10 relative z-10">
        <div>
            <h1 class="text-3xl font-bold text-white">
                Dulce Rewards
            </h1>
            <p class="text-sm text-gray-400">
                Plataforma de fidelidad · {{ auth()->user()->name }}
            </p>
        </div>
    </div>

    <!-- Cards -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl relative z-10">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            @if(auth()->user()->rol === 'admin')

                <!-- Sucursales -->
                <a href="{{ route('sucursales.index') }}"
                   class="group bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-6 transition hover:scale-[1.02]">

                    <div class="text-3xl mb-3">🏬</div>

                    <h3 class="text-white font-semibold group-hover:text-pink-400 transition">
                        Sucursales
                    </h3>

                    <p class="text-sm text-gray-400">
                        Controla puntos por ubicación
                    </p>
                </a>

                <!-- Usuarios -->
                <a href="{{ route('users.index') }}"
                   class="group bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-6 transition hover:scale-[1.02]">

                    <div class="text-3xl mb-3">👥</div>

                    <h3 class="text-white font-semibold group-hover:text-pink-400 transition">
                        Usuarios
                    </h3>

                    <p class="text-sm text-gray-400">
                        Accesos y permisos del sistema
                    </p>
                </a>

                <!-- Premios -->
                <a href="{{ route('premios.index') }}"
                   class="group bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-6 transition hover:scale-[1.02]">

                    <div class="text-3xl mb-3">🎁</div>

                    <h3 class="text-white font-semibold group-hover:text-pink-400 transition">
                        Recompensas
                    </h3>

                    <p class="text-sm text-gray-400">
                        Premios disponibles para canje
                    </p>
                </a>

            @endif

            <!-- Clientes -->
            <a href="{{ route('clientes.index') }}"
               class="group bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-6 transition hover:scale-[1.02]">

                <div class="text-3xl mb-3">💳</div>

                <h3 class="text-white font-semibold group-hover:text-pink-400 transition">
                    Clientes
                </h3>

                <p class="text-sm text-gray-400">
                    Registro y acumulación de puntos
                </p>
            </a>

            <!-- Movimientos -->
            <a href="{{ route('movimientos.index') }}"
               class="group bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-6 transition hover:scale-[1.02]">

                <div class="text-3xl mb-3">📊</div>

                <h3 class="text-white font-semibold group-hover:text-pink-400 transition">
                    Movimientos
                </h3>

                <p class="text-sm text-gray-400">
                    Historial de puntos y canjes
                </p>
            </a>

        </div>

    </div>

    <!-- Botón logout -->
    <button
        onclick="event.preventDefault(); if(confirm('¿Cerrar sesión?')) document.getElementById('logout-form').submit();"
        class="fixed bottom-6 right-24 bg-red-500 hover:bg-red-600 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-xl transition hover:scale-110">

        <i class="bi bi-box-arrow-right text-[20px]"></i>
    </button>

    <!-- HOME -->
    <a href="{{ route('dashboard') }}"
       class="fixed bottom-6 right-6 bg-pink-500 hover:bg-pink-600 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-xl transition hover:scale-110">

        <i class="bi bi-house text-[20px]"></i>
    </a>

</div>

@endsection