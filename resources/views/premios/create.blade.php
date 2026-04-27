@extends('layouts.dashboard')

@section('title', 'Nuevo Premio')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="mb-6">
        <h1 class="text-xl text-white font-semibold">Nuevo Premio</h1>
        <p class="text-sm text-gray-400">Agrega una recompensa</p>
    </div>

    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">

        <form action="{{ route('premios.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre</label>
                <input type="text" name="nombre"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    required>
            </div>

            <!-- PUNTOS -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Puntos requeridos</label>
                <input type="number" name="puntos_requeridos"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    required>
            </div>

            <!-- CIUDAD -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Ciudad</label>
                <input type="text" name="ciudad"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    placeholder="Ej. Chihuahua (vacío = global)">
            </div>

            <!-- ACTIVO -->
            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="activo" value="1" checked
                    class="rounded bg-white/5 border border-white/10 text-blue-500 focus:ring-blue-500">

                <label class="text-sm text-gray-300">
                    Activo
                </label>
            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('premios.index') }}"
                   class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg">
                    Cancelar
                </a>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Guardar
                </button>

            </div>

        </form>

    </div>

</div>

@endsection