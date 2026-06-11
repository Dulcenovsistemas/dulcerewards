<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dulce Rewards</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">

    <style>

        body{
            font-family:'Montserrat',sans-serif;
        }

        .title-font{
            font-family:'Cormorant Garamond',serif;
        }

        .bg-dulce{
            background:
            radial-gradient(circle at top left,
            rgba(255,255,255,.12),
            transparent 35%),

            radial-gradient(circle at bottom right,
            rgba(255,255,255,.08),
            transparent 30%),

            linear-gradient(
            135deg,
            #C57B91 0%,
            #B66F86 45%,
            #A8657C 100%
            );
        }

        @keyframes float {
            0%{transform:translateY(0px);}
            50%{transform:translateY(-12px);}
            100%{transform:translateY(0px);}
        }

        .float{
            animation:float 5s ease-in-out infinite;
        }

    </style>

</head>

<body class="bg-dulce min-h-screen overflow-x-hidden">

<div class="relative min-h-screen">

    <!-- Navbar -->
    <header class="absolute top-0 left-0 w-full z-20">

        <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">

            <img
                src="{{ asset('images/dulcerewards.png') }}"
                alt="Dulce Rewards"
                class="h-10 md:h-12">

            @if (Route::has('login'))

                @auth

                    <a href="{{ url('/dashboard') }}"
                       class="bg-white text-[#b56f86] px-6 py-2 rounded-full font-medium hover:scale-105 transition">
                        Dashboard
                    </a>

                @else

                    <a href="{{ route('login') }}"
                       class="border border-white/40 text-white px-6 py-2 rounded-full hover:bg-white hover:text-[#b56f86] transition">
                        Iniciar sesión
                    </a>

                @endauth

            @endif

        </div>

    </header>

   
<section class="min-h-screen flex items-center overflow-hidden">

        <div class="max-w-7xl mx-auto px-6 w-full">

            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <!-- Texto -->
                <div class="text-center lg:text-left">

                    <p class="text-white/90 tracking-[0.3em] uppercase text-sm mb-4">
                        Bienvenido a
                    </p>

                    <h1 class="title-font text-white text-6xl md:text-7xl lg:text-8xl leading-none font-light">
                        Dulce
                        <br>
                        Rewards
                    </h1>

                    <p class="text-white/80 text-lg md:text-xl max-w-lg mt-8 mx-auto lg:mx-0 leading-relaxed">
                        Acumula puntos en cada compra y canjéalos por descuentos,
                        beneficios exclusivos y recompensas diseñadas especialmente para ti.
                    </p>

                    <div class="mt-10">

                        @auth

                            <a href="{{ url('/dashboard') }}"
                               class="inline-flex bg-white text-[#b56f86] px-8 py-4 rounded-full font-medium shadow-xl hover:scale-105 transition">
                                Entrar al sistema
                            </a>

                        @else

                            <a href="{{ route('login') }}"
                               class="inline-flex bg-white text-[#b56f86] px-8 py-4 rounded-full font-medium shadow-xl hover:scale-105 transition">
                                Comenzar
                            </a>

                        @endauth

                    </div>

                </div>

              <!-- Mockup -->

<div class="relative h-[700px] overflow-visible">

    <img
        src="{{ asset('images/celular.png') }}"
        alt="App Dulce Rewards"
        class="
            absolute
            bottom-[-350px]
            right-0
            w-[850px]
            max-w-none
        ">

</div>

            </div>

        </div>

    </section>

    <!-- Footer -->
    <footer class="absolute bottom-0 left-0 w-full pb-6">

        <div class="max-w-7xl mx-auto px-6">

            <p class="text-white/60 text-xs text-center">
                Programa de lealtad de Dulce Noviembre.
                Los beneficios, promociones y recompensas pueden variar según disponibilidad.
            </p>

        </div>

    </footer>

</div>

</body>
</html>