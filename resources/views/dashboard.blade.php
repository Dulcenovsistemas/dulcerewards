@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<div class="relative max-w-7xl mx-auto">

    <!-- Glow decorativos -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-pink-400/5 rounded-full blur-[150px] pointer-events-none"></div>

    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white/5 rounded-full blur-[150px] pointer-events-none"></div>

    <!-- Header -->
    <div class="relative z-10 mb-10">

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                <div class="flex items-center gap-5">

                    <img
                        src="{{ asset('images/dulcerewards.png') }}"
                        alt="Dulce Rewards"
                        class="h-16">

                    <div>

                        <p class="text-white/60 text-sm uppercase tracking-[0.2em]">
                            Bienvenido
                        </p>

                        <h1 class="text-3xl font-light text-white">
                            {{ auth()->user()->name }}
                        </h1>

                        <p class="text-white/60 mt-1">
                            Panel administrativo de Dulce Rewards
                        </p>

                    </div>

                </div>

                <div class="text-white/50 text-sm">
                    {{ now()->format('d/m/Y') }}
                </div>

            </div>

        </div>

    </div>

    <!-- Descripción -->
    <div class="relative z-10 mb-8">

        <h2 class="text-white text-2xl font-light">
            Centro de control
        </h2>

        <p class="text-white/60 mt-2">
            Gestiona clientes, recompensas, movimientos y configuraciones desde un solo lugar.
        </p>

    </div>

    <!-- Dashboard -->
    <div class="relative z-10">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- CONFIGURACIÓN --}}
            @if(auth()->user()->rol === 'admin')
            <div class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 transition-all duration-300 hover:-translate-y-1 hover:border-pink-300/20 hover:shadow-[0_20px_60px_rgba(255,255,255,0.05)]">

                <div class="flex items-center gap-4 mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-[#D08AA0]/15 flex items-center justify-center">
                        <i class="bi bi-gear text-3xl text-[#FFD9E4]"></i>
                    </div>

                    <div>

                        <h2 class="text-2xl font-semibold text-white">
                            Configuración
                        </h2>

                        <p class="text-gray-400 text-sm">
                            Administración general del sistema
                        </p>

                    </div>

                </div>

                <div class="space-y-3">

                    <a href="{{ route('sucursales.index') }}"
                       class="flex items-center justify-between bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-4 transition">

                        <div class="flex items-center gap-3">
                            <i class="bi bi-shop text-[#FFD9E4]"></i>
                            <span class="text-white">Sucursales</span>
                        </div>

                        <i class="bi bi-chevron-right text-gray-500"></i>

                    </a>

                    <a href="{{ route('users.index') }}"
                       class="flex items-center justify-between bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-4 transition">

                        <div class="flex items-center gap-3">
                            <i class="bi bi-people text-[#FFD9E4]"></i>
                            <span class="text-white">Usuarios</span>
                        </div>

                        <i class="bi bi-chevron-right text-gray-500"></i>

                    </a>

                    <a href="{{ route('premios.index') }}"
                       class="flex items-center justify-between bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-4 transition">

                        <div class="flex items-center gap-3">
                            <i class="bi bi-gift text-[#FFD9E4]"></i>
                            <span class="text-white">Recompensas</span>
                        </div>

                        <i class="bi bi-chevron-right text-gray-500"></i>

                    </a>

                </div>

            </div>
            @endif

            {{-- CLIENTES --}}
            <div class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 transition-all duration-300 hover:-translate-y-1 hover:border-pink-300/20 hover:shadow-[0_20px_60px_rgba(255,255,255,0.05)]">

                <div class="flex items-center gap-4 mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-[#D08AA0]/15 flex items-center justify-center">
                        <i class="bi bi-people-fill text-3xl text-[#FFD9E4]"></i>
                    </div>

                    <div>

                        <h2 class="text-2xl font-semibold text-white">
                            Clientes
                        </h2>

                        <p class="text-gray-400 text-sm">
                            Administración de clientes registrados
                        </p>

                    </div>

                </div>

                <a href="{{ route('clientes.index') }}"
                   class="flex items-center justify-between bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-4 transition">

                    <div class="flex items-center gap-3">
                        <i class="bi bi-card-list text-[#FFD9E4]"></i>
                        <span class="text-white">Listado de clientes</span>
                    </div>

                    <i class="bi bi-chevron-right text-gray-500"></i>

                </a>

            </div>

            {{-- MOVIMIENTOS --}}
            <div class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 transition-all duration-300 hover:-translate-y-1 hover:border-pink-300/20 hover:shadow-[0_20px_60px_rgba(255,255,255,0.05)]">

                <div class="flex items-center gap-4 mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-[#D08AA0]/15 flex items-center justify-center">
                        <i class="bi bi-arrow-left-right text-3xl text-[#FFD9E4]"></i>
                    </div>

                    <div>

                        <h2 class="text-2xl font-semibold text-white">
                            Movimientos
                        </h2>

                        <p class="text-gray-400 text-sm">
                            Operación diaria del programa de puntos
                        </p>

                    </div>

                </div>

                <a href="{{ route('jornadas.index') }}"
                   class="flex items-center justify-between bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-4 transition">

                    <div class="flex items-center gap-3">
                        <i class="bi bi-journal-text text-[#FFD9E4]"></i>
                        <span class="text-white">Registro de puntos y canjes</span>
                    </div>

                    <i class="bi bi-chevron-right text-gray-500"></i>

                </a>

            </div>

            {{-- REPORTES --}}
            <div class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 transition-all duration-300 hover:-translate-y-1 hover:border-pink-300/20 hover:shadow-[0_20px_60px_rgba(255,255,255,0.05)]">

                <div class="flex items-center gap-4 mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-[#D08AA0]/15 flex items-center justify-center">
                        <i class="bi bi-bar-chart-line text-3xl text-[#FFD9E4]"></i>
                    </div>

                    <div>

                        <h2 class="text-2xl font-semibold text-white">
                            Reportes
                        </h2>

                        <p class="text-gray-400 text-sm">
                            Consultas y estadísticas del programa
                        </p>

                    </div>

                </div>

                <a href="{{ route('reportes.index') }}"
                    class="flex items-center justify-between bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-4 transition">

                        <div class="flex items-center gap-3">
                            <i class="bi bi-file-earmark-bar-graph text-[#FFD9E4]"></i>
                            <span class="text-white">Generar reportes</span>
                        </div>

                        <i class="bi bi-chevron-right text-gray-500"></i>

                </a>

            </div>


        </div>

    </div>
    <button
    onclick="event.preventDefault(); if(confirm('¿Cerrar sesión?')) document.getElementById('logout-form').submit();"
    class="
        fixed
        bottom-6
        right-6
        z-50

        w-14
        h-14

        rounded-full

        bg-white/10
        backdrop-blur-xl
        border
        border-white/10

        text-red-300

        flex
        items-center
        justify-center

        shadow-xl

        transition-all
        duration-300

        hover:bg-red-500/20
        hover:text-red-200
        hover:scale-110
    ">

    <i class="bi bi-box-arrow-right text-xl"></i>

</button>

</div>

@endsection