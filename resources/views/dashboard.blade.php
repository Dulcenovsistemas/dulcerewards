@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-semibold text-white">
                Panel de Control
            </h1>
            <p class="text-sm text-gray-400">
                Administra tu sistema de fidelidad
            </p>
        </div>

        <div class="text-sm text-gray-300">
            {{ auth()->user()->name }}
        </div>
    </div>

    <!-- Panel -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <!-- Sucursales -->
            <a href="{{ route('sucursales.index') }}"
               class="group bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-5 transition">

                <div class="text-2xl mb-3">🏬</div>

                <h3 class="text-white font-semibold group-hover:text-blue-400 transition">
                    Sucursales
                </h3>

                <p class="text-sm text-gray-400">
                    Gestiona todas las sucursales
                </p>
            </a>

            <!-- Usuarios -->
            <a href="{{ route('users.index') }}"
               class="group bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-5 transition">

                <div class="text-2xl mb-3">👥</div>

                <h3 class="text-white font-semibold group-hover:text-blue-400 transition">
                    Usuarios
                </h3>

                <p class="text-sm text-gray-400">
                    Administra usuarios del sistema
                </p>
            </a>

            <!-- Clientes -->
            <a href="{{ route('clientes.index') }}"
               class="group bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-5 transition">

                <div class="text-2xl mb-3">💳</div>

                <h3 class="text-white font-semibold group-hover:text-blue-400 transition">
                    Clientes
                </h3>

                <p class="text-sm text-gray-400">
                    Sistema de fidelidad
                </p>
            </a>


            <!-- Premios -->
            <a href="{{ route('premios.index') }}"
               class="group bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-5 transition">

                <div class="text-2xl mb-3">🎁</div>

                <h3 class="text-white font-semibold group-hover:text-blue-400 transition">
                    Premios
                </h3>

                <p class="text-sm text-gray-400">
                    Sistema de fidelidad
                </p>
            </a>

            <!-- Premios -->
            <a href="{{ route('movimientos.index') }}"
               class="group bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl p-5 transition">

                <div class="text-2xl mb-3">📊</div>

                <h3 class="text-white font-semibold group-hover:text-blue-400 transition">
                    Movimientos
                </h3>

                <p class="text-sm text-gray-400">
                    Sistema de fidelidad
                </p>
            </a>

        </div>

    </div>

</div>

@endsection