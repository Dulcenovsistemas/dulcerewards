@extends('layouts.dashboard')

@section('title', 'Clientes')

@section('content')

<div class="relative max-w-7xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8 relative z-10">
        <div>
            <h1 class="text-2xl text-white font-bold">Clientes</h1>
            <p class="text-sm text-gray-400">
                Gestiona la base de clientes y su participación en Dulce Rewards
            </p>
        </div>

        <a href="{{ route('clientes.create') }}"
           class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-lg shadow-pink-500/30">
            + Nuevo cliente
        </a>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 relative z-10">

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">Total clientes</p>
            <h3 class="text-white text-3xl font-bold">
                {{ $clientes->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">Con correo registrado</p>
            <h3 class="text-pink-400 text-3xl font-bold">
                {{ $clientes->whereNotNull('email')->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">Con cumpleaños</p>
            <h3 class="text-green-400 text-3xl font-bold">
                {{ $clientes->whereNotNull('fecha_nacimiento')->count() }}
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
                        <th class="px-6 py-4 text-left">Cliente</th>
                        <th class="px-6 py-4 text-left">Teléfono</th>
                        <th class="px-6 py-4 text-left">Sucursal</th>
                        <th class="px-6 py-4 text-left">Registro</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-white/5">

                    @forelse($clientes as $cliente)
                    <tr class="hover:bg-white/5 transition">

                        <!-- CLIENTE -->
                        <td class="px-6 py-4 flex items-center gap-3">

                            <div class="w-10 h-10 rounded-full bg-pink-500/20 flex items-center justify-center text-xs text-pink-300 font-semibold">
                                {{ strtoupper(substr($cliente->nombre, 0, 2)) }}
                            </div>

                            <div>
                                <p class="text-white font-medium">
                                    {{ $cliente->nombre }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    ID: {{ $cliente->id }}
                                </p>
                            </div>

                        </td>

                        <!-- TELÉFONO -->
                        <td class="px-6 py-4 text-gray-400">
                            {{ $cliente->telefono }}
                        </td>

                        <!-- SUCURSAL -->
                        <td class="px-6 py-4 text-gray-400">
                            {{ $cliente->sucursal->nombre ?? '—' }}
                        </td>

                        <!-- FECHA -->
                        <td class="px-6 py-4 text-gray-400">
                            {{ $cliente->created_at->format('d/m/Y') }}
                        </td>

                        <!-- ACCIONES -->
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4 text-gray-400">

                                <!-- Editar -->
                                <a href="{{ route('clientes.edit', $cliente) }}"
                                   target="_blank"
                                   class="hover:text-pink-400 transition"
                                   title="Editar cliente">
                                    <i class="bi bi-pencil-square"></i> 
                                </a>

                                <!-- Tarjeta -->
                                <a href="{{ url('/cliente/'.$cliente->qr_token) }}"
                                   target="_blank"
                                   class="hover:text-white transition"
                                   title="Ver tarjeta digital">
                                    <i class="bi bi-wallet-fill"></i>
                                </a>

                                <!-- WhatsApp -->
                                <a href="https://wa.me/{{ $cliente->telefono }}?text=Hola%20{{ urlencode($cliente->nombre) }}%20👋%0ATe%20compartimos%20tu%20tarjeta%20digital:%0A{{ route('wallet.show', $cliente->qr_token) }}"
                                   target="_blank"
                                   class="hover:text-green-400 transition"
                                   title="Enviar por WhatsApp">
                                   <i class="bi bi-send-fill"></i>
                                </a>

                                <!-- Eliminar -->
                                <form method="POST" action="{{ route('clientes.destroy', $cliente) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('¿Eliminar cliente?')"
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
                            No hay clientes registrados
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