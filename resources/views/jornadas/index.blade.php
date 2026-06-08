@extends('layouts.dashboard')

@section('title', 'Jornadas')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-3xl font-bold text-white">
                Jornadas
            </h1>

            <p class="text-gray-400">
                Control y seguimiento de operaciones diarias
            </p>
        </div>

        <a href="{{ route('jornadas.create') }}"
           class="inline-flex items-center gap-2 px-5 py-3 bg-pink-500 hover:bg-pink-600 text-white rounded-xl shadow-lg transition">

            <i class="bi bi-plus-lg"></i>
            Nueva Jornada
        </a>

    </div>

    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-white/5 border-b border-white/10">

                <tr>

                    <th class="px-6 py-4 text-left text-gray-300 font-medium">
                        Folio
                    </th>

                    <th class="px-6 py-4 text-left text-gray-300 font-medium">
                        Fecha
                    </th>

                    <th class="px-6 py-4 text-left text-gray-300 font-medium">
                        Responsable
                    </th>

                    <th class="px-6 py-4 text-left text-gray-300 font-medium">
                        Sucursal
                    </th>

                    <th class="px-6 py-4 text-left text-gray-300 font-medium">
                        Estado
                    </th>

                    <th class="px-6 py-4 text-right text-gray-300 font-medium">
                        Acciones
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($jornadas as $jornada)

                    <tr class="border-b border-white/5 hover:bg-white/5 transition">

                        <td class="px-6 py-4 text-white font-medium">
                            {{ $jornada->folio }}
                        </td>

                        <td class="px-6 py-4 text-gray-300">
                            {{ \Carbon\Carbon::parse($jornada->fecha)->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-4 text-gray-300">
                            {{ $jornada->usuario->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-300">
                            {{ $jornada->sucursal->nombre }}
                        </td>

                        <td class="px-6 py-4">

                            @if($jornada->estado == 'abierta')

                                <span class="px-3 py-1 rounded-full text-xs bg-green-500/20 text-green-400 border border-green-500/20">
                                    Abierta
                                </span>

                            @elseif($jornada->estado == 'cerrada')

                                <span class="px-3 py-1 rounded-full text-xs bg-gray-500/20 text-gray-300 border border-gray-500/20">
                                    Cerrada
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full text-xs bg-red-500/20 text-red-400 border border-red-500/20">
                                    Cancelada
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-end gap-2">

                                <a href="{{ route('jornadas.edit', $jornada) }}"
                                   class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 transition"
                                   title="Abrir jornada">

                                    <i class="bi bi-box-arrow-in-right"></i>

                                </a>

                                 @if($jornada->estado === 'abierta')

                                <form action="{{ route('jornadas.cerrar', $jornada) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        onclick="return confirm('¿Cerrar esta jornada?')"
                                        class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500/10 hover:bg-red-500/20 text-red-400 transition"
                                        title="Cerrar jornada">

                                        <i class="bi bi-lock-fill"></i>

                                    </button>

                                </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-12 text-gray-400">

                            <i class="bi bi-calendar-x text-4xl block mb-3"></i>

                            No existen jornadas registradas.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">
        {{ $jornadas->links() }}
    </div>

</div>

@endsection