@extends('layouts.dashboard')

@section('title', 'Editar Premio')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-xl text-white font-semibold">Editar Premio</h1>
        <p class="text-sm text-gray-400">Modifica la información del premio</p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">

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

        <form action="{{ route('premios.update', $premio) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre</label>
                <input type="text" name="nombre"
                    value="{{ old('nombre', $premio->nombre) }}"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    required>
            </div>

            <!-- PUNTOS -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Puntos requeridos</label>
                <input type="number" name="puntos_requeridos"
                    value="{{ old('puntos_requeridos', $premio->puntos_requeridos) }}"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    required>
            </div>

            <!-- CIUDAD -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Ciudad</label>
                <input type="text" name="ciudad"
                    value="{{ old('ciudad', $premio->ciudad) }}"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

            <!-- ACTIVO -->
            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="activo" value="1"
                    {{ old('activo', $premio->activo) ? 'checked' : '' }}
                    class="rounded bg-white/5 border border-white/10 text-blue-500 focus:ring-blue-500">

                <label class="text-sm text-gray-300">
                    Activo
                </label>
            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('premios.index') }}"
                   class="px-4 py-2 rounded-lg text-sm text-gray-300 hover:bg-white/10 transition">
                    Cancelar
                </a>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition shadow">
                    Actualizar
                </button>

            </div>

        </form>

    </div>

</div>

@endsection