@extends('layouts.dashboard')

@section('title', 'Detalle Usuario')

@section('content')

<div class="relative max-w-2xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[400px] h-[400px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="mb-8 relative z-10 flex items-center gap-4">

        <div class="w-14 h-14 rounded-full bg-pink-500/20 flex items-center justify-center text-pink-300 font-semibold text-lg">
            {{ strtoupper(substr($user->name, 0, 2)) }}
        </div>

        <div>
            <h1 class="text-2xl text-white font-bold">{{ $user->name }}</h1>
            <p class="text-sm text-gray-400">Perfil de usuario</p>
        </div>

    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 space-y-6 shadow-2xl relative z-10">

        <!-- INFO GRID -->
        <div class="grid grid-cols-1 gap-5">

            <!-- EMAIL -->
            <div>
                <p class="text-gray-400 text-xs uppercase tracking-wide">Correo electrónico</p>
                <p class="text-white mt-1">{{ $user->email }}</p>
            </div>

            <!-- ROL -->
            <div>
                <p class="text-gray-400 text-xs uppercase tracking-wide mb-1">Rol</p>

                <span class="px-3 py-1 text-xs rounded-full
                    {{ $user->rol == 'admin'
                        ? 'bg-pink-500/20 text-pink-400'
                        : 'bg-green-500/20 text-green-400' }}">
                    {{ $user->rol == 'admin' ? 'Administrador' : 'Usuario de sucursal' }}
                </span>
            </div>

            <!-- SUCURSAL -->
            <div>
                <p class="text-gray-400 text-xs uppercase tracking-wide">Sucursal asignada</p>
                <p class="text-white mt-1">
                    {{ $user->sucursal->nombre ?? 'Sin asignar' }}
                </p>
            </div>

        </div>

        <!-- ACCIONES -->
        <div class="flex justify-end gap-3 pt-4">

            <a href="{{ route('users.index') }}"
               class="px-4 py-2 text-gray-300 hover:bg-white/10 rounded-lg transition">
                Volver
            </a>

            <a href="{{ route('users.edit', $user) }}"
               class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-lg transition shadow-lg shadow-pink-500/30">
                Editar usuario
            </a>

        </div>

    </div>

</div>

@endsection