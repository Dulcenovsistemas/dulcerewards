@extends('layouts.dashboard')

@section('title', 'Clientes')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl text-white font-semibold">Clientes</h1>
            <p class="text-sm text-gray-400">Administra los clientes del sistema</p>
        </div>

        <a href="{{ route('clientes.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            + Nuevo cliente
        </a>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Total clientes</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $clientes->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Con correo</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $clientes->whereNotNull('email')->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Con cumpleaños</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $clientes->whereNotNull('fecha_nacimiento')->count() }}
            </h3>
        </div>

    </div>

    <!-- TABLA -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden">

        <div class="max-h-[60vh] overflow-y-auto">

            <table class="w-full text-sm text-gray-300">

                <!-- HEADER -->
                <thead class="border-b border-white/10 text-gray-400 text-xs uppercase bg-black/20 backdrop-blur sticky top-0 z-10">
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

                            <div class="w-9 h-9 rounded-full bg-purple-500/20 flex items-center justify-center text-xs text-purple-300 font-semibold">
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

                                <a href="{{ route('clientes.edit', $cliente) }}"
                                target="_blank"
                                class="hover:text-white transition">

                                    ✏️ 
                                </a>

                                <!-- VER TARJETA -->
                                <a href="{{ url('/cliente/'.$cliente->qr_token) }}"
                                target="_blank"
                                class="hover:text-white transition"
                                title="Ver tarjeta">
                                🎫
                                </a>

                                <!-- WHATSAPP -->
                                <a href="https://wa.me/{{ $cliente->telefono }}?text=Hola%20{{ urlencode($cliente->nombre) }}%20👋%0ATe%20compartimos%20tu%20tarjeta%20digital:%0A{{ route('wallet.show', $cliente->qr_token) }}"
                                target="_blank"
                                class="hover:text-green-400 transition"
                                title="Enviar por WhatsApp">
                                📲
                                </a>

                                <!-- Eliminar -->
                                <form method="POST" action="{{ route('clientes.destroy', $cliente) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('¿Eliminar cliente?')"
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

        <!-- HOME -->
        <a href="{{ route('dashboard') }}"
        class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-xl transition">

            <i class="bi bi-house text-[20px] leading-none"></i>

        </a>

</div>

@endsection