@extends('layouts.dashboard')

@section('title', 'Reportes')

@section('content')

<div class="relative max-w-7xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8 relative z-10">

        <div>
            <h1 class="text-2xl text-white font-bold">
                Reportes
            </h1>

            <p class="text-sm text-gray-400">
                Consulta estadísticas de clientes, puntos, canjes y jornadas
            </p>
        </div>

    </div>

    <!-- FILTROS -->
<div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-xl mb-6 relative z-10">

    <form method="GET" action="{{ route('reportes.index') }}">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <!-- Fecha inicio -->
            <div>
                <label class="block text-xs text-gray-400 mb-2">
                    Fecha inicio
                </label>

                <input
                    type="date"
                    name="fecha_inicio"
                    value="{{ request('fecha_inicio') }}"
                    class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2 text-white">
            </div>

            <!-- Fecha fin -->
            <div>
                <label class="block text-xs text-gray-400 mb-2">
                    Fecha fin
                </label>

                <input
                    type="date"
                    name="fecha_fin"
                    value="{{ request('fecha_fin') }}"
                    class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2 text-white">
            </div>

            <div class="flex items-end">
                <button
                    type="submit"
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white px-5 py-2.5 rounded-xl font-medium transition">
                    Consultar
                </button>
            </div>

           
        </div>

    </form>




    </div>

    
    <!-- RESUMEN -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6 relative z-10">

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">
                Clientes
            </p>

            <h3 class="text-white text-3xl font-bold">
                {{ $totalClientes ?? 0 }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">
                Puntos
            </p>

            <h3 class="text-pink-400 text-3xl font-bold">
                {{ $totalPuntos ?? 0 }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">
                Canjes
            </p>

            <h3 class="text-green-400 text-3xl font-bold">
                {{ $totalCanjes ?? 0 }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5 backdrop-blur-xl">
            <p class="text-gray-400 text-sm">
                Jornadas
            </p>

            <h3 class="text-blue-400 text-3xl font-bold">
                {{ $totalJornadas ?? 0 }}
            </h3>
        </div>

    </div>

   <!-- TABLA -->
<div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden relative z-10">

    <div class="p-4 border-b border-white/10 flex justify-between items-center">

    <h2 class="text-white font-semibold">
        Reporte por sucursal
    </h2>

    <a href="{{ route('reportes.exportar', [
            'fecha_inicio' => request('fecha_inicio'),
            'fecha_fin' => request('fecha_fin')
        ]) }}"
       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl text-sm">

        <i class="bi bi-file-earmark-excel"></i>
        Exportar Excel

    </a>

</div>

    <div class="max-h-[60vh] overflow-y-auto">

        <table class="w-full text-sm text-gray-300">

            <thead class="border-b border-white/10 text-gray-400 text-xs uppercase bg-black/30 sticky top-0 z-10">

                <tr>
                    <th class="px-6 py-4 text-left">
                        Sucursal
                    </th>

                    <th class="px-6 py-4 text-left">
                        Clientes
                    </th>

                    <th class="px-6 py-4 text-left">
                        Puntos
                    </th>

                    <th class="px-6 py-4 text-left">
                        Canjes
                    </th>
                </tr>

            </thead>

            <tbody class="divide-y divide-white/5">

                @forelse($reporte as $item)

                    <tr class="hover:bg-white/5">

                        <td class="px-6 py-4 text-white font-medium">
                            {{ $item['nombre'] }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item['clientes'] }}
                        </td>

                        <td class="px-6 py-4 text-pink-400">
                            {{ $item['puntos'] }}
                        </td>

                        <td class="px-6 py-4 text-green-400">
                            {{ $item['canjes'] }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-500">
                            No hay datos disponibles
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>



</div>

@endsection