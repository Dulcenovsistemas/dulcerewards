<div class="max-w-sm mx-auto">

    <h2 class="text-white font-semibold mb-3">📊 Movimientos</h2>

    <div class="space-y-3 max-h-[300px] overflow-y-auto pr-1">

        @forelse($movimientos as $mov)

        <div class="bg-white/5 border border-white/10 rounded-xl p-4 flex justify-between items-center">

            <div>
                <p class="text-sm text-white">
                    {{ $mov->descripcion ?? 'Movimiento' }}
                </p>

                <p class="text-xs text-gray-400">
                    {{ optional($mov->created_at)->format('d/m/Y') }}
                </p>
            </div>

            <div class="text-right">
                <p class="
                    font-semibold text-sm
                    {{ $mov->puntos > 0 ? 'text-green-400' : 'text-red-400' }}
                ">
                    {{ $mov->puntos > 0 ? '+' : '' }}{{ $mov->puntos }}
                </p>
            </div>

        </div>

        @empty

        <p class="text-gray-500 text-sm text-center">
            Sin movimientos
        </p>

        @endforelse

    </div>

</div>