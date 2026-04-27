@extends('layouts.dashboard')

@section('title', 'Registrar compra')

@section('content')

<div class="max-w-xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-xl text-white font-semibold">Registrar compra</h1>
        <p class="text-sm text-gray-400">Ingresa los datos del cliente</p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">

        <form action="{{ route('movimientos.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- TELEFONO -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Teléfono del cliente
                </label>

                <input type="text" name="telefono"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="Ej. 6561234567"
                    required>
            </div>

            <!-- CANTIDAD -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Número de pasteles
                </label>

                <input type="number" name="cantidad" min="1"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="Ej. 3"
                    required>
            </div>

            <!-- ALERTA -->
            <div class="text-xs text-yellow-400 bg-yellow-500/10 border border-yellow-500/20 p-3 rounded-lg">
                ⚠️ Los pasteles minis no cuentan para acumulación de puntos
            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('movimientos.index') }}"
                   class="text-gray-300 hover:bg-white/10 px-4 py-2 rounded-lg">
                    Cancelar
                </a>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium">
                    Registrar compra
                </button>

            </div>

        </form>

    </div>

</div>

@endsection