<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Iniciar sesión | Dulce Rewards</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

        .card-glass{
            background:rgba(255,255,255,.12);
            backdrop-filter:blur(24px);
            border:1px solid rgba(255,255,255,.15);
        }
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
    </style>
</head>

<body class="bg-dulce min-h-screen flex items-center justify-center p-6">

<div class="relative w-full max-w-md px-6">


    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[400px] h-[400px] bg-pink-500/20 blur-[120px]"></div>

    <!-- Card -->
    <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-2xl animate-fade-in">

    

        <div class="text-center mb-8">

            <img
                src="{{ asset('images/dulcerewards.png') }}"
                alt="Dulce Rewards"
                class="h-20 mx-auto mb-6">


            <p class="text-white/70 mt-3">
                Accede a tu cuenta para consultar puntos,
                recompensas y beneficios exclusivos.
            </p>

        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-400 text-center">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="text-sm text-gray-300">Correo electrónico</label>
                <input 
                    type="email" 
                    name="email"
                    value="{{ old('email') }}"
                    required autofocus
                    class="mt-1 w-full px-4 py-2 bg-white/10 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500"
                    placeholder="ejemplo@correo.com"
                >
                @error('email')
                    <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="text-sm text-gray-300">Contraseña</label>
                <input 
                    type="password" 
                    name="password"
                    required
                    class="mt-1 w-full px-4 py-2 bg-white/10 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember + Forgot -->
            <div class="flex items-center justify-between text-sm">

                <label class="flex items-center gap-2 text-gray-400">
                    <input type="checkbox" name="remember" class="rounded border-white/20 bg-white/10">
                    Recordarme
                </label>

                

            </div>

            <!-- Button -->
           <button
    type="submit"
    class="w-full bg-white text-[#B66F86] py-3 rounded-xl font-medium hover:scale-[1.02] transition shadow-xl"
>
    Iniciar sesión
</button>

        </form>

    </div>

</div>

</body>
</html>