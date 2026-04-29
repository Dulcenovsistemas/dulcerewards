<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dulce Rewards</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        .animate-fade-in-delay {
            animation: fadeIn 1.2s ease-out;
        }
    </style>

</head>

<body class="bg-[#0b0b0f] min-h-screen">

<div class="relative min-h-screen flex items-center justify-center overflow-hidden">

    <!-- 🎨 Glow más "dulce" -->
    <div class="absolute inset-0">
        <div class="absolute top-[-100px] left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-pink-500/20 blur-[120px]"></div>
        <div class="absolute bottom-[-100px] right-[-100px] w-[400px] h-[400px] bg-purple-500/20 blur-[120px]"></div>
    </div>

    <div class="relative z-10 max-w-6xl w-full px-6">

        <!-- Navbar -->
        <div class="flex justify-between items-center mb-16">
            <div class="text-white">
                <h1 class="text-lg font-semibold tracking-wide">
                    Dulce Rewards
                </h1>
                <p class="text-xs text-white/50">
                    by Dulce Noviembre
                </p>
            </div>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="text-sm text-white/80 hover:text-white transition">
                        Dashboard →
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-sm text-white/80 hover:text-white transition">
                        Iniciar sesión →
                    </a>
                @endauth
            @endif
        </div>

        <!-- Hero -->
        <div class="grid md:grid-cols-2 gap-12 items-center">

            <!-- Texto -->
            <div class="text-white space-y-6 animate-fade-in">

                <h2 class="text-4xl md:text-5xl font-bold leading-tight">
                    Convierte cada compra en
                    <span class="text-pink-400">recompensas</span>
                </h2>

                <p class="text-gray-400 text-lg">
                    Gestiona clientes, acumula puntos y premia la lealtad.
                    Todo en una plataforma diseñada para hacer crecer tu negocio.
                </p>

                <div class="flex gap-4 pt-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="bg-pink-500 hover:bg-pink-600 px-6 py-3 rounded-xl font-medium transition shadow-lg shadow-pink-500/30">
                            Ir al sistema
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="bg-pink-500 hover:bg-pink-600 px-6 py-3 rounded-xl font-medium transition shadow-lg shadow-pink-500/30">
                            Iniciar sesión
                        </a>
                    @endauth
                </div>

            </div>

            <!-- Card preview -->
            <div class="relative animate-fade-in-delay">

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl">

                    <h3 class="text-white font-semibold mb-4">
                        Actividad reciente
                    </h3>

                    <div class="space-y-3 text-sm text-gray-300">

                        <div class="flex justify-between">
                            <span>Cliente registrado</span>
                            <span class="text-green-400">+1</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Puntos acumulados</span>
                            <span class="text-pink-400">+120 pts</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Premio canjeado</span>
                            <span class="text-white">Pastel gratis</span>
                        </div>

                    </div>

                    <div class="mt-6">
                        <div class="text-xs text-gray-400 mb-1">
                            Progreso del cliente
                        </div>

                        <div class="h-2 bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full w-3/4 bg-pink-500"></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>