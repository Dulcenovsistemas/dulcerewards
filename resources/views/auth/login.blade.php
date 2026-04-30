<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Iniciar sesión | Dulce Rewards</title>

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
    </style>
</head>

<body class="bg-[#0b0b0f] min-h-screen flex items-center justify-center">

<div class="relative w-full max-w-md px-6">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[400px] h-[400px] bg-pink-500/20 blur-[120px]"></div>

    <!-- Card -->
    <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-2xl animate-fade-in">

        <!-- Logo / Branding -->
        <div class="text-center mb-6">
            <h1 class="text-white text-xl font-semibold">Dulce Rewards</h1>
            <p class="text-xs text-white/50">by Dulce Noviembre</p>
        </div>

        <!-- Mensaje -->
        <div class="text-center mb-6">
            <h2 class="text-white text-2xl font-bold mb-2">
                Bienvenido de nuevo
            </h2>
            <p class="text-gray-400 text-sm">
                Inicia sesión para gestionar puntos y recompensas
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

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-pink-400 hover:text-pink-300 transition">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

            </div>

            <!-- Button -->
            <button 
                type="submit"
                class="w-full bg-pink-500 hover:bg-pink-600 text-white py-2.5 rounded-lg font-medium transition shadow-lg shadow-pink-500/30"
            >
                Iniciar sesión
            </button>

        </form>

    </div>

</div>

</body>
</html>