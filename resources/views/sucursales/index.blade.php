@extends('layouts.dashboard')

@section('title', 'Sucursales')

@section('content')

<div class="relative max-w-7xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8 relative z-10">
        <div>
            <h1 class="text-2xl text-white font-bold">Sucursales</h1>
            <p class="text-sm text-gray-400">Gestión de puntos por ubicación</p>
        </div>

        <a href="{{ route('sucursales.create') }}"
           class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-lg shadow-pink-500/30">
            + Nueva sucursal
        </a>
    </div>

    <!-- BANNER -->
    <div class="mb-6 bg-gradient-to-r from-pink-500/10 to-purple-500/10 border border-pink-500/20 p-4 rounded-xl">
        <p class="text-sm text-pink-300">
            Administra las sucursales donde tus clientes acumulan y canjean recompensas.
        </p>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">Total sucursales</p>
            <h3 class="text-white text-3xl font-bold">
                {{ $sucursales->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">Ciudades activas</p>
            <h3 class="text-white text-3xl font-bold">
                {{ $sucursales->pluck('ciudad')->unique()->count() }}
            </h3>
        </div>

    </div>

    <!-- TABLA -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden">

        <div class="max-h-[60vh] overflow-y-auto">

            <table class="w-full text-sm text-gray-300">

                <!-- HEADER -->
                <thead class="border-b border-white/10 text-gray-400 text-xs uppercase bg-black/30 sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Sucursal</th>
                        <th class="px-6 py-4 text-left">Ciudad</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-white/5">

                    @forelse($sucursales as $sucursal)
                    <tr class="hover:bg-white/5 transition">

                        <!-- ID -->
                        <td class="px-6 py-4 text-gray-500">
                            #{{ $sucursal->id }}
                        </td>

                        <!-- NOMBRE -->
                        <td class="px-6 py-4 flex items-center gap-3">

                            <div class="w-9 h-9 rounded-full bg-pink-500/20 flex items-center justify-center text-xs text-pink-300 font-semibold">
                                {{ strtoupper(substr($sucursal->nombre, 0, 2)) }}
                            </div>

                            <span class="text-white font-medium">
                                {{ $sucursal->nombre }}
                            </span>

                        </td>

                        <!-- CIUDAD -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs bg-white/10 text-gray-300 rounded-full">
                                {{ $sucursal->ciudad ?? 'Sin ciudad' }}
                            </span>
                        </td>

                        <!-- ACCIONES -->
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4 text-gray-400">

                                <!-- Editar -->
                                <a href="{{ route('sucursales.edit', $sucursal) }}"
                                   class="hover:text-pink-400 transition">
                                   <i class="bi bi-pencil-square"></i> 
                                </a>

                                <!-- Eliminar -->
                                <form method="POST" action="{{ route('sucursales.destroy', $sucursal) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('¿Eliminar sucursal?')"
                                            class="hover:text-red-400 transition">
                                            <i class="bi bi-x-circle"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-500">
                            No hay sucursales registradas
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