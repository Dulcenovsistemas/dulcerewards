@extends('layouts.dashboard')

@section('title', 'Nueva Jornada')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-white">
            Nueva Jornada
        </h1>

        <p class="text-gray-400 mt-1">
            Inicia una nueva jornada de operaciones.
        </p>

    </div>

    <form action="{{ route('jornadas.store') }}" method="POST"
          class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8">

        @csrf

        <div class="space-y-6">

            {{-- Responsable --}}
            <div>

                <label class="block text-sm text-gray-400 mb-2">
                    Responsable
                </label>

                <input
                    type="text"
                    value="{{ auth()->user()->name }}"
                    disabled
                    class="w-full rounded-xl bg-white/5 border border-white/10 text-gray-300 px-4 py-3">

            </div>

            {{-- Sucursal --}}
            <div>

                <label class="block text-sm text-gray-400 mb-2">
                    Sucursal
                </label>

                <select
                    name="sucursal_id"
                    required
                    class="w-full rounded-xl bg-white/5 border border-white/10 text-white px-4 py-3">

                    <option value="">
                        Selecciona una sucursal
                    </option>

                    @foreach($sucursales as $sucursal)

                        <option value="{{ $sucursal->id }}">
                            {{ $sucursal->nombre }}
                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Fecha --}}
            <div>

                <label class="block text-sm text-gray-400 mb-2">
                    Fecha
                </label>

                <input
                    type="date"
                    name="fecha"
                    value="{{ date('Y-m-d') }}"
                    required
                    class="w-full rounded-xl bg-white/5 border border-white/10 text-white px-4 py-3">

            </div>

            {{-- Observaciones --}}
            <div>

                <label class="block text-sm text-gray-400 mb-2">
                    Observaciones
                </label>

                <textarea
                    name="observaciones"
                    rows="4"
                    class="w-full rounded-xl bg-white/5 border border-white/10 text-white px-4 py-3"></textarea>

            </div>

        </div>

        <div class="flex justify-end gap-3 mt-8">

            <a href="{{ route('jornadas.index') }}"
               class="px-5 py-3 rounded-xl border border-white/10 text-gray-300 hover:bg-white/5">

                Cancelar
            </a>

            <button
                type="submit"
                class="px-5 py-3 bg-pink-500 hover:bg-pink-600 text-white rounded-xl">

                <i class="bi bi-play-fill mr-1"></i>
                Abrir Jornada

            </button>

        </div>

    </form>

</div>

@endsection