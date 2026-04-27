@extends('layouts.dashboard')

@section('title', 'Editar Sucursal')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-xl text-white font-semibold">Editar Sucursal</h1>
        <p class="text-sm text-gray-400">Modifica la información de la sucursal</p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">

        <form action="{{ route('sucursales.update', $sucursal) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Nombre
                </label>

                <input type="text" name="nombre"
                    value="{{ old('nombre', $sucursal->nombre) }}"
                    class="w-full bg-white/5 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
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
                    class="w-full bg-white/5 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    placeholder="Ej. Juárez">

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
                    class="w-full bg-white/5 border border-white/10 text-white placeholder-gray-400 px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    placeholder="Ej. Av. Tecnológico #123">

                @error('direccion')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- BOTONES -->
            <div class="flex justify-between items-center pt-4">

                

                <!-- Acciones -->
                <div class="flex gap-3">
                    <a href="{{ route('sucursales.index') }}"
                       class="px-4 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 transition">
                        Cancelar
                    </a>

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition shadow">
                        Actualizar
                    </button>
                </div>

            </div>

        </form>

    </div>

</div>

@endsection