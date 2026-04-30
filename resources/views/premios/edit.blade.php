@extends('layouts.dashboard')

@section('title', 'Editar Recompensa')

@section('content')

<div class="relative max-w-2xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[400px] h-[400px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="mb-8 relative z-10">
        <h1 class="text-2xl text-white font-bold">Editar Recompensa</h1>
        <p class="text-sm text-gray-400">
            Actualiza la configuración de esta recompensa
        </p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl relative z-10">

        <!-- ERRORES -->
        @if ($errors->any())
            <div class="mb-4 bg-red-500/10 border border-red-500/20 text-red-400 p-3 rounded-lg text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('premios.update', $premio) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre de la recompensa</label>
                <input type="text" name="nombre"
                    value="{{ old('nombre', $premio->nombre) }}"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    required>
            </div>

            <!-- PUNTOS -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Puntos requeridos</label>
                <input type="number" name="puntos_requeridos"
                    value="{{ old('puntos_requeridos', $premio->puntos_requeridos) }}"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    required>
            </div>

            <!-- CIUDAD (SELECT) -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Disponibilidad por ciudad</label>

                <select name="ciudad"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition">

                    <option value="">Todas las sucursales (Global)</option>

                    @php
                        $ciudades = [
                            'CUAUHTEMOC',
                            'CHIHUAHUA',
                            'JUAREZ',
                            'DELICIAS',
                            'PARRAL',
                            'MEOQUI',
                            'CAMARGO',
                            'RUBIO',
                            'LAS JUNTAS',
                            'GUERRERO'
                        ];
                    @endphp

                    @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad }}"
                            {{ old('ciudad', $premio->ciudad) == $ciudad ? 'selected' : '' }}>
                            {{ ucfirst(strtolower($ciudad)) }}
                        </option>
                    @endforeach

                </select>

                <p class="text-xs text-gray-500 mt-1">
                    Define en qué ciudad estará disponible esta recompensa.
                </p>
            </div>

            <!-- ACTIVO -->
            <div class="flex items-center justify-between bg-white/5 border border-white/10 rounded-xl px-4 py-3">

                <div>
                    <p class="text-sm text-white font-medium">Disponible</p>
                    <p class="text-xs text-gray-400">
                        Permite que los clientes puedan canjear esta recompensa
                    </p>
                </div>

                <input type="checkbox" name="activo" value="1"
                    {{ old('activo', $premio->activo) ? 'checked' : '' }}
                    class="w-5 h-5 rounded bg-white/10 border border-white/10 text-pink-500 focus:ring-pink-500">
            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('premios.index') }}"
                   class="px-4 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 transition">
                    Cancelar
                </a>

                <button
                    class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-lg shadow-pink-500/30 hover:scale-105">
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

</div>

@endsection