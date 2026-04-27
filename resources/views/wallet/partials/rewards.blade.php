<div class="max-w-sm mx-auto mb-6">



    <div class="grid grid-cols-2 gap-3">

        @foreach($premios as $premio)

        @php
            $esDisponible = $premioActual && $premio->id === $premioActual->id;
        @endphp

        <div class="
    relative flex flex-col justify-between
    p-4 rounded-2xl
    backdrop-blur-md
    border
    transition-all duration-300
    hover:scale-[1.04]
    
    {{ $esDisponible 
        ? 'bg-[#d29ba8]/15 border-[#d29ba8]/40 shadow-[0_0_25px_rgba(210,155,168,0.25)]' 
        : 'bg-white/5 border-white/10 opacity-80' 
    }}
">

            <!-- Texto -->
            <div class="flex flex-col">
                <span class="
                    text-sm font-semibold
                    {{ $esDisponible ? 'text-green-300' : 'text-white' }}
                ">
                    {{ $premio->nombre }}
                </span>

                <span class="
                    text-xs
                    {{ $esDisponible ? 'text-green-400' : 'text-gray-400' }}
                ">
                    {{ $premio->puntos_requeridos }} pts
                </span>
            </div>

            <!-- Badge -->
            @if($esDisponible)
                <span class="
                    text-[10px] px-3 py-1
                    rounded-full
                    bg-green-400/20
                    text-green-300
                    font-semibold
                    border border-green-400/30
                ">
                    ✔ Disponible
                </span>
            @endif

        </div>

        @endforeach

    </div>

</div>