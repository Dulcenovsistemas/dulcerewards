@extends('layouts.dashboard')

@section('title', 'Usuarios')

@section('content')

<div class="relative max-w-7xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8 relative z-10">
        <div>
            <h1 class="text-2xl text-white font-bold">Usuarios</h1>
            <p class="text-sm text-gray-400">Control de accesos en Dulce Rewards</p>
        </div>

        <a href="{{ route('users.create') }}"
           class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-lg shadow-pink-500/30">
            + Nuevo usuario
        </a>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 relative z-10">

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">Total usuarios</p>
            <h3 class="text-white text-3xl font-bold">
                {{ $users->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">Administradores</p>
            <h3 class="text-pink-400 text-3xl font-bold">
                {{ $users->where('rol','admin')->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">Usuarios sucursal</p>
            <h3 class="text-green-400 text-3xl font-bold">
                {{ $users->where('rol','sucursal')->count() }}
            </h3>
        </div>

    </div>

    <!-- TABLA -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden relative z-10">

        <div class="max-h-[60vh] overflow-y-auto">

            <table class="w-full text-sm text-gray-300">

                <!-- HEADER -->
                <thead class="border-b border-white/10 text-gray-400 text-xs uppercase bg-black/30 sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-4 text-left">Usuario</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Rol</th>
                        <th class="px-6 py-4 text-left">Sucursal</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-white/5">

                    @forelse($users as $user)
                    <tr class="hover:bg-white/5 transition">

                        <!-- USUARIO -->
                        <td class="px-6 py-4 flex items-center gap-3">

                            <div class="w-9 h-9 rounded-full bg-pink-500/20 flex items-center justify-center text-xs text-pink-300 font-semibold">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>

                            <div>
                                <p class="text-white font-medium">
                                    {{ $user->name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    ID: {{ $user->id }}
                                </p>
                            </div>

                        </td>

                        <!-- EMAIL -->
                        <td class="px-6 py-4 text-gray-400">
                            {{ $user->email }}
                        </td>

                        <!-- ROL -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full
                                {{ $user->rol == 'admin'
                                    ? 'bg-pink-500/20 text-pink-400'
                                    : 'bg-green-500/20 text-green-400' }}">
                                {{ $user->rol == 'admin' ? 'Admin' : 'Sucursal' }}
                            </span>
                        </td>

                        <!-- SUCURSAL -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs bg-white/10 rounded-full text-gray-300">
                                {{ $user->sucursal->nombre ?? '—' }}
                            </span>
                        </td>

                        <!-- ACCIONES -->
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4 text-gray-400">

                                <!-- Ver -->
                                <a href="{{ route('users.show', $user) }}" class="hover:text-white transition">
                                    <i class="bi bi-eye-fill"></i>
                                </a>

                                <!-- Editar -->
                                <a href="{{ route('users.edit', $user) }}"
                                   class="hover:text-pink-400 transition">
                                    <i class="bi bi-pencil-square"></i> 
                                </a>

                                <!-- Eliminar -->
                                <form method="POST" action="{{ route('users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('¿Eliminar usuario?')"
                                            class="hover:text-red-400 transition">
                                       <i class="bi bi-x-circle"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            No hay usuarios registrados
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