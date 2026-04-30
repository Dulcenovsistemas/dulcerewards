@extends('layouts.dashboard')

@section('title', 'Editar Sucursal')

@section('content')

<div class="relative max-w-2xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[400px] h-[400px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="mb-8 relative z-10 flex items-center gap-4">

        <div class="w-12 h-12 rounded-full bg-pink-500/20 flex items-center justify-center text-pink-300 font-semibold">
            {{ strtoupper(substr($sucursal->nombre, 0, 2)) }}
        </div>

        <div>
            <h1 class="text-2xl text-white font-bold">Editar Sucursal</h1>
            <p class="text-sm text-gray-400">
                Actualiza la información de esta sucursal
            </p>
        </div>

    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl relative z-10">

        <form action="{{ route('sucursales.update', $sucursal) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Nombre de la sucursal
                </label>

                <input type="text" name="nombre"
                    value="{{ old('nombre', $sucursal->nombre) }}"
                    class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="Ej. Sucursal Centro"
                    required>

                @error('nombre')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- CIUDAD -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Ciudad
                </label>

                <input type="text" name="ciudad"
                    value="{{ old('ciudad', $sucursal->ciudad) }}"
                    class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="Ej. Ciudad Juárez">

                @error('ciudad')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- DIRECCIÓN -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Dirección
                </label>

                <input type="text" name="direccion"
                    value="{{ old('direccion', $sucursal->direccion) }}"
                    class="w-full bg-white/10 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="Ej. Av. Tecnológico #123">

                @error('direccion')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('sucursales.index') }}"
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