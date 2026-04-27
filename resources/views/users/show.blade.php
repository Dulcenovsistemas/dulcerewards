@extends('layouts.dashboard')

@section('title', 'Detalle Usuario')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-xl text-white font-semibold">Detalle del Usuario</h1>
        <p class="text-sm text-gray-400">Información completa</p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 space-y-4">

        <!-- NOMBRE -->
        <div>
            <p class="text-gray-400 text-sm">Nombre</p>
            <p class="text-white font-medium">{{ $user->name }}</p>
        </div>

        <!-- EMAIL -->
        <div>
            <p class="text-gray-400 text-sm">Email</p>
            <p class="text-white">{{ $user->email }}</p>
        </div>

        <!-- ROL -->
        <div>
            <p class="text-gray-400 text-sm">Rol</p>
            <span class="px-3 py-1 text-xs rounded-full
                {{ $user->rol == 'admin'
                    ? 'bg-blue-500/20 text-blue-400'
                    : 'bg-green-500/20 text-green-400' }}">
                {{ ucfirst($user->rol) }}
            </span>
        </div>

        <!-- SUCURSAL -->
        <div>
            <p class="text-gray-400 text-sm">Sucursal</p>
            <p class="text-white">
                {{ $user->sucursal->nombre ?? '—' }}
            </p>
        </div>

        <!-- BOTONES -->
        <div class="flex justify-end gap-3 pt-4">

            <a href="{{ route('users.index') }}"
               class="px-4 py-2 text-gray-300 hover:bg-white/10 rounded-lg">
                Volver
            </a>

            <a href="{{ route('users.edit', $user) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Editar
            </a>

        </div>

    </div>

</div>

@endsection