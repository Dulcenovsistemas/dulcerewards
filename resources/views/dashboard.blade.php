@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<div class="relative max-w-7xl mx-auto">

    <!-- Glow decorativo -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- Header -->
    <div class="flex justify-between items-center mb-10 relative z-10">

        <div>
            <h1 class="text-4xl font-bold text-white">
                Dulce Rewards
            </h1>

            <p class="text-gray-400 mt-1">
                Plataforma de fidelidad · {{ auth()->user()->name }}
            </p>
        </div>

    </div>

    <!-- Dashboard -->
    <div class="relative z-10">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- CONFIGURACIÓN --}}
            @if(auth()->user()->rol === 'admin')
            <div class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-300 hover:-translate-y-1">

                <div class="flex items-center gap-4 mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-pink-500/15 flex items-center justify-center">
                        <i class="bi bi-gear text-3xl text-pink-400"></i>
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
                            <i class="bi bi-shop text-pink-400"></i>
                            <span class="text-white">Sucursales</span>
                        </div>

                        <i class="bi bi-chevron-right text-gray-500"></i>
                    </a>

                    <a href="{{ route('users.index') }}"
                       class="flex items-center justify-between bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-4 transition">

                        <div class="flex items-center gap-3">
                            <i class="bi bi-people text-pink-400"></i>
                            <span class="text-white">Usuarios</span>
                        </div>

                        <i class="bi bi-chevron-right text-gray-500"></i>
                    </a>

                    <a href="{{ route('premios.index') }}"
                       class="flex items-center justify-between bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-4 transition">

                        <div class="flex items-center gap-3">
                            <i class="bi bi-gift text-pink-400"></i>
                            <span class="text-white">Recompensas</span>
                        </div>

                        <i class="bi bi-chevron-right text-gray-500"></i>
                    </a>

                </div>

            </div>
            @endif

            {{-- CLIENTES --}}
            <div class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-300 hover:-translate-y-1">

                <div class="flex items-center gap-4 mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-blue-500/15 flex items-center justify-center">
                        <i class="bi bi-people-fill text-3xl text-blue-400"></i>
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
                        <i class="bi bi-card-list text-blue-400"></i>
                        <span class="text-white">Listado de clientes</span>
                    </div>

                    <i class="bi bi-chevron-right text-gray-500"></i>
                </a>

            </div>

            {{-- MOVIMIENTOS --}}
            <div class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-300 hover:-translate-y-1">

                <div class="flex items-center gap-4 mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-green-500/15 flex items-center justify-center">
                        <i class="bi bi-arrow-left-right text-3xl text-green-400"></i>
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
                        <i class="bi bi-journal-text text-green-400"></i>
                        <span class="text-white">Registro de puntos y canjes</span>
                    </div>

                    <i class="bi bi-chevron-right text-gray-500"></i>
                </a>

            </div>

            {{-- REPORTES --}}
            <div class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-300 hover:-translate-y-1">

                <div class="flex items-center gap-4 mb-6">

                    <div class="w-16 h-16 rounded-2xl bg-amber-500/15 flex items-center justify-center">
                        <i class="bi bi-bar-chart-line text-3xl text-amber-400"></i>
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

                <a href="#"
                   class="flex items-center justify-between bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-4 transition">

                    <div class="flex items-center gap-3">
                        <i class="bi bi-file-earmark-bar-graph text-amber-400"></i>
                        <span class="text-white">Generar reportes</span>
                    </div>

                    <i class="bi bi-chevron-right text-gray-500"></i>
                </a>

            </div>

        </div>

    </div>

    <!-- Logout -->
    <button
        onclick="event.preventDefault(); if(confirm('¿Cerrar sesión?')) document.getElementById('logout-form').submit();"
        class="fixed bottom-6 right-24 bg-red-500 hover:bg-red-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-xl transition hover:scale-110">

        <i class="bi bi-box-arrow-right text-xl"></i>
    </button>

    <!-- Home -->
    <a href="{{ route('dashboard') }}"
       class="fixed bottom-6 right-6 bg-pink-500 hover:bg-pink-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-xl transition hover:scale-110">

        <i class="bi bi-house text-xl"></i>
    </a>

</div>

@endsection