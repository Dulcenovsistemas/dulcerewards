<div class="w-full mb-6">

    <div class="relative bg-gradient-to-br from-[#d29ba8] via-[#b57c8a] to-[#7a4f5d] rounded-3xl p-6 shadow-2xl text-white overflow-hidden">

        <!-- glow -->
        <div class="absolute inset-0 bg-white/10 backdrop-blur-xl"></div>

        <div class="relative z-10">

            <!-- header -->
            <div class="flex justify-between items-center mb-6">
                <img src="{{ asset('images/logo.png') }}" class="h-10">

                <span class="text-xs bg-white/20 px-3 py-1 rounded-full">
                    Cliente
                </span>
            </div>

            <div class="mb-4">

                <div class="flex justify-between items-center mb-2">
                    <p class="text-sm opacity-80">Puntos</p>
                    <p class="text-sm opacity-80">
                        {{ $puntos }} / 10
                    </p>
                </div>

                <h3 class="text-3xl font-bold mb-3">
                    {{ $puntos }} ⭐
                </h3>

                <!-- barra -->
                <div class="w-full h-3 bg-white/20 rounded-full overflow-hidden">
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