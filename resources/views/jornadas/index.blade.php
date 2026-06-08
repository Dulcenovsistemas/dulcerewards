@extends('layouts.dashboard')

@section('title', 'Jornadas')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-bold text-white">
                Jornadas
            </h1>

            <p class="text-gray-400">
                Control y seguimiento de operaciones diarias
            </p>
        </div>

        <a href="{{ route('jornadas.create') }}"
           class="inline-flex items-center gap-2 px-5 py-3 bg-pink-500 hover:bg-pink-600 text-white rounded-xl shadow-lg transition">

            <i class="bi bi-plus-lg"></i>
            Nueva Jornada
        </a>

    </div>

    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-white/5 border-b border-white/10">

                <tr>

                    <th class="px-6 py-4 text-left text-gray-300 font-medium">
                        Folio
                    </th>

                    <th class="px-6 py-4 text-left text-gray-300 font-medium">
                        Fecha
                    </th>

                    <th class="px-6 py-4 text-left text-gray-300 font-medium">
                        Responsable
                    </th>

                    <th class="px-6 py-4 text-left text-gray-300 font-medium">
                        Sucursal
                    </th>

                    <th class="px-6 py-4 text-left text-gray-300 font-medium">
                        Estado
                    </th>

                    <th class="px-6 py-4 text-right text-gray-300 font-medium">
                        Acciones
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($jornadas as $jornada)

                    <tr class="border-b border-white/5 hover:bg-white/5 transition">

                        <td class="px-6 py-4 text-white font-medium">
                            {{ $jornada->folio }}
                        </td>

                        <td class="px-6 py-4 text-gray-300">
                            {{ \Carbon\Carbon::parse($jornada->fecha)->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-4 text-gray-300">
                            {{ $jornada->usuario->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-300">
                            {{ $jornada->sucursal->nombre }}
                        </td>

                        <td class="px-6 py-4">

                            @if($jornada->estado == 'abierta')

                                <span class="px-3 py-1 rounded-full text-xs bg-green-500/20 text-green-400 border border-green-500/20">
                                    Abierta
                                </span>

                            @elseif($jornada->estado == 'cerrada')

                                <span class="px-3 py-1 rounded-full text-xs bg-gray-500/20 text-gray-300 border border-gray-500/20">
                                    Cerrada
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full text-xs bg-red-500/20 text-red-400 border border-red-500/20">
                                    Cancelada
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-end gap-2">

                                <a href="{{ route('jornadas.edit', $jornada) }}"
                                   class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 transition"
                                   title="Abrir jornada">

                                    <i class="bi bi-box-arrow-in-right"></i>

                                </a>

                                 @if($jornada->estado === 'abierta')

                                <form action="{{ route('jornadas.cerrar', $jornada) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        onclick="return confirm('¿Cerrar esta jornada?')"
                                        class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500/10 hover:bg-red-500/20 text-red-400 transition"
                                        title="Cerrar jornada">

                                        <i class="bi bi-lock-fill"></i>

                                    </button>

                                </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-12 text-gray-400">

                            <i class="bi bi-calendar-x text-4xl block mb-3"></i>

                            No existen jornadas registradas.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">
        {{ $jornadas->links() }}
    </div>

    <!-- LOGOUT -->
            <button
                onclick="event.preventDefault(); if(confirm('¿Cerrar sesión?')) document.getElementById('logout-form').submit();"
                class="fixed bottom-6 right-24 bg-red-600 hover:bg-red-700 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-xl transition">

                <i class="bi bi-box-arrow-right text-[20px] leading-none"></i>

            </button>

            <!-- HOME MENU FLOTANTE -->

            <div class="fixed bottom-6 right-6 z-50">

                    <!-- OPCIONES -->
                    <div id="menuHome"
                        class="flex flex-col items-end gap-3 mb-3 opacity-0 pointer-events-none transition-all duration-300">

                        <!-- Volver -->
                        <button onclick="history.back()"
                            class="w-12 h-12 rounded-full bg-gray-700 hover:bg-gray-600 text-white shadow-lg flex items-center justify-center">

                            <i class="bi bi-arrow-left"></i>

                        </button>

                        <!-- Movimientos -->
                        <a href="{{ route('jornadas.index') }}"
                        class="w-12 h-12 rounded-full bg-green-600 hover:bg-green-700 text-white shadow-lg flex items-center justify-center">

                            <i class="bi bi-arrow-left-right"></i>

                        </a>

                        <!-- Clientes -->
                        <a href="{{ route('clientes.index') }}"
                        class="w-12 h-12 rounded-full bg-pink-600 hover:bg-pink-700 text-white shadow-lg flex items-center justify-center">

                            <i class="bi bi-people-fill"></i>

                        </a>

                        <!-- Inicio -->
                        <a href="{{ route('dashboard') }}"
                        class="w-12 h-12 rounded-full bg-blue-600 hover:bg-blue-700 text-white shadow-lg flex items-center justify-center">

                            <i class="bi bi-house-fill"></i>

                        </a>

                    </div>

                    <!-- BOTON PRINCIPAL -->
                    <button id="btnMenu"
                        onclick="toggleMenu()"
                        class="bg-blue-600 hover:bg-blue-700 text-white w-14 h-14 rounded-full shadow-xl flex items-center justify-center transition">

                        <i id="iconMenu" class="bi bi-list text-[22px]"></i>

                    </button>

            </div>

</div>

<script>
    function toggleMenu() {

    const menu = document.getElementById('menuHome');
    const icon = document.getElementById('iconMenu');

    if(menu.classList.contains('opacity-0')) {

        menu.classList.remove('opacity-0');
        menu.classList.remove('pointer-events-none');

        icon.classList.remove('bi-list');
        icon.classList.add('bi-x-lg');

    } else {

        menu.classList.add('opacity-0');
        menu.classList.add('pointer-events-none');

        icon.classList.remove('bi-x-lg');
        icon.classList.add('bi-list');

    }

}
</script>

@endsection