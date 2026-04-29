<div class="w-full mb-6">

    <div class="relative 
        bg-gradient-to-br from-[#d29ba8] via-[#b57c8a] to-[#7a4f5d] 
        rounded-3xl 
        px-6 py-7
        min-h-[220px]
        shadow-2xl 
        text-white 
        overflow-hidden">

        <!-- glow -->
        <div class="absolute inset-0 bg-white/10 backdrop-blur-xl"></div>

        <div class="relative z-10 flex flex-col justify-between h-full">

            <!-- header -->
            <div class="flex justify-between items-start">
                <img src="{{ asset('images/logo.png') }}" class="h-14">

                <div class="flex gap-2 flex-wrap">

 
                    @if($vigencia)
                        <span class="text-sm px-3 py-1 rounded-full
                            {{ $vigenciaVencida ? 'bg-red-500/20 text-red-400' : 'bg-green-500/20 text-green-400' }}">

                            {{ $vigenciaVencida ? 'Vencida' : 'Vigente' }}
                        </span>

                        <span class="text-xs bg-white/10 px-3 py-1 rounded-full text-gray-300">
                            {{ $vigencia->format('d/m/Y') }}
                        </span>

                      
                    @endif

                </div>
            </div>

            <!-- contenido -->
            <div>

                <div class="flex justify-between items-center mb-2">
                    <p class="text-base opacity-80">Puntos</p>
                    <p class="text-base opacity-80">
                        {{ $puntos }} / 10
                    </p>
                </div>

                <h3 class="text-5xl font-bold mb-4">
                    {{ $puntos }} 
                </h3>

                <!-- barra -->
                <div class="w-full h-4 bg-white/20 rounded-full overflow-hidden">
                    <div class="h-full rounded-full
                        bg-gradient-to-r from-[#f3c7d0] to-[#d29ba8]
                        transition-all duration-500"
                        style="width: {{ min(($puntos / 10) * 100, 100) }}%">
                    </div>
                </div>

            </div>

        </div>

        <!-- decor -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-black/20 rounded-full blur-2xl"></div>

    </div>

</div>