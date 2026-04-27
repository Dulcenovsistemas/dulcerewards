@extends('layouts.dashboard')

@section('title', 'Nueva Sucursal')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-xl text-white font-semibold">Nueva Sucursal</h1>
        <p class="text-sm text-gray-400">Agrega una nueva sucursal al sistema</p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">

        <form action="{{ route('sucursales.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Nombre
                </label>

                <input type="text" name="nombre"
                    class="w-full bg-white/5 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    placeholder="Ej. Sucursal Centro"
                    required>
            </div>

            <!-- CIUDAD -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Ciudad
                </label>

                <input type="text" name="ciudad"
                    class="w-full bg-white/5 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    placeholder="Ej. Juárez">
            </div>

            <!-- DIRECCIÓN -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Dirección
                </label>

                <input type="text" name="direccion"
                    class="w-full bg-white/5 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    placeholder="Ej. Av. Tecnológico #123">
            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('sucursales.index') }}"
                   class="px-4 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 transition">
                    Cancelar
                </a>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition shadow">
                    Guardar
                </button>

            </div>

        </form>

    </div>

</div>

@endsection