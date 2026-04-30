@extends('layouts.dashboard')

@section('title', 'Nueva Recompensa')

@section('content')

<div class="relative max-w-2xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[400px] h-[400px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="mb-8 relative z-10">
        <h1 class="text-2xl text-white font-bold">Nueva Recompensa</h1>
        <p class="text-sm text-gray-400">
            Define un beneficio que los clientes podrán canjear con sus puntos
        </p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl relative z-10">

        <form action="{{ route('premios.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre de la recompensa</label>
                <input type="text" name="nombre"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="Ej. Pastel gratis"
                    required>
            </div>

            <!-- PUNTOS -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Puntos requeridos</label>
                <input type="number" name="puntos_requeridos"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="Ej. 150"
                    required>

                <p class="text-xs text-gray-500 mt-1">
                    Cantidad de puntos necesarios para canjear esta recompensa.
                </p>
            </div>

            <!-- CIUDAD -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Disponibilidad por ciudad</label>

                <select name="ciudad"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition">

                    <option value="">Todas las sucursales (Global)</option>

                    <option value="CUAUHTEMOC">Cuauhtémoc</option>
                    <option value="CHIHUAHUA">Chihuahua</option>
                    <option value="JUAREZ">Juárez</option>
                    <option value="DELICIAS">Delicias</option>
                    <option value="PARRAL">Parral</option>
                    <option value="MEOQUI">Meoqui</option>
                    <option value="CAMARGO">Camargo</option>
                    <option value="RUBIO">Rubio</option>
                    <option value="LAS JUNTAS">Las Juntas</option>
                    <option value="GUERRERO">Guerrero</option>

                </select>

                <p class="text-xs text-gray-500 mt-1">
                    Si seleccionas una ciudad, la recompensa solo estará disponible en esa zona.
                </p>
            </div>

            <!-- ACTIVO -->
            <div class="flex items-center justify-between bg-white/5 border border-white/10 rounded-xl px-4 py-3">

                <div>
                    <p class="text-sm text-white font-medium">Disponible</p>
                    <p class="text-xs text-gray-400">
                        Determina si los clientes pueden canjear esta recompensa
                    </p>
                </div>

                <input type="checkbox" name="activo" value="1" checked
                    class="w-5 h-5 rounded bg-white/10 border border-white/10 text-pink-500 focus:ring-pink-500">
            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('premios.index') }}"
                   class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg transition">
                    Cancelar
                </a>

                <button
                    class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2.5 rounded-xl font-medium transition shadow-lg shadow-pink-500/30 hover:scale-105">
                    Crear recompensa
                </button>

            </div>

        </form>

    </div>

</div>

@endsection