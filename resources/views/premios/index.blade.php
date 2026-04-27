@extends('layouts.dashboard')

@section('title', 'Premios')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl text-white font-semibold">Premios</h1>
            <p class="text-sm text-gray-400">Administra las recompensas</p>
        </div>

        <a href="{{ route('premios.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            + Nuevo premio
        </a>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Total premios</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $premios->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Activos</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $premios->where('activo', true)->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Globales</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $premios->whereNull('ciudad')->count() }}
            </h3>
        </div>

    </div>

    <!-- TABLA -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden">

        <div class="max-h-[60vh] overflow-y-auto">

            <table class="w-full text-sm text-gray-300">

                <!-- HEADER -->
                <thead class="border-b border-white/10 text-gray-400 text-xs uppercase bg-black/20 sticky top-0">
                    <tr>
                        <th class="px-6 py-4 text-left">Premio</th>
                        <th class="px-6 py-4 text-left">Puntos</th>
                        <th class="px-6 py-4 text-left">Ciudad</th>
                        <th class="px-6 py-4 text-left">Estado</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-white/5">

                    @forelse($premios as $premio)
                    <tr class="hover:bg-white/5 transition">

                        <!-- NOMBRE -->
                        <td class="px-6 py-4">
                            <p class="text-white font-medium">
                                {{ $premio->nombre }}
                            </p>
                        </td>

                        <!-- PUNTOS -->
                        <td class="px-6 py-4 text-gray-400">
                            {{ $premio->puntos_requeridos }} pts
                        </td>

                        <!-- CIUDAD -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs bg-white/10 rounded-full text-gray-300">
                                {{ $premio->ciudad ?? 'Global' }}
                            </span>
                        </td>

                        <!-- ESTADO -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full
                                {{ $premio->activo
                                    ? 'bg-green-500/20 text-green-400'
                                    : 'bg-red-500/20 text-red-400' }}">
                                {{ $premio->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>

                        <!-- ACCIONES -->
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4 text-gray-400">

                                <!-- Editar -->
                                <a href="{{ route('premios.edit', $premio) }}"
                                   class="hover:text-blue-400 transition">
                                    ✏
                                </a>

                                <!-- Eliminar -->
                                <form method="POST" action="{{ route('premios.destroy', $premio) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('¿Eliminar premio?')"
                                            class="hover:text-red-400 transition">
                                        ❌
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            No hay premios registrados
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
            class="fixed bottom-6 right-24 bg-red-600 hover:bg-red-700 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-xl transition">

            <i class="bi bi-box-arrow-right text-[20px] leading-none"></i>

        </button>

        <!-- HOME -->
        <a href="{{ route('dashboard') }}"
        class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-xl transition">

            <i class="bi bi-house text-[20px] leading-none"></i>

        </a>

</div>

@endsection