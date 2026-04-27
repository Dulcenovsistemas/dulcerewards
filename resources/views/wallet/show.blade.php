@extends('layouts.wallet')

@section('content')

<div class="min-h-screen relative px-4 pb-24">

    <!-- 👤 HEADER (nombre fuera de tarjeta) -->
    <div class="flex justify-between items-center mb-6 mt-4">

        <div>
            <p class="text-xs text-gray-400">Bienvenida</p>
            <h1 class="text-lg font-semibold text-white">
                {{ $cliente->nombre }}
            </h1>
        </div>

        <!-- 🔳 BOTÓN QR -->
        <button onclick="abrirQR()" class="
            w-12 h-12 flex items-center justify-center
            rounded-full
            bg-white/10 backdrop-blur-md
            border border-white/10
            shadow-lg
            hover:scale-105 transition
        ">
            <i class="bi bi-qr-code text-white text-lg"></i>
        </button>

    </div>

    <!-- 💳 TARJETA -->
    @include('wallet.partials.card')

    <!-- 🎁 RECOMPENSAS -->
    @include('wallet.partials.rewards')

    <!-- 📊 MOVIMIENTOS -->
    @include('wallet.partials.movimientos')

</div>

<!-- 📱 NAVBAR INFERIOR -->
<div class="
    fixed bottom-0 left-0 w-full
    bg-white/5 backdrop-blur-xl
    border-t border-white/10
">

    <div class="max-w-md mx-auto flex justify-around py-3 text-white">

        <button class="flex flex-col items-center text-xs opacity-80 hover:opacity-100">
            <i class="bi bi-house text-lg"></i>
            Inicio
        </button>

        <button class="flex flex-col items-center text-xs opacity-80 hover:opacity-100">
            <i class="bi bi-gift text-lg"></i>
            Premios
        </button>

        <button class="flex flex-col items-center text-xs opacity-80 hover:opacity-100">
            <i class="bi bi-clock-history text-lg"></i>
            Historial
        </button>

        <a href="{{ route('perfil', $cliente->qr_token) }}" class="flex flex-col items-center text-xs opacity-80 hover:opacity-100">
            <i class="bi bi-person text-lg"></i>
            Perfil
        </a>

    </div>
</div>

<div id="qrModal" class="
    fixed inset-0 z-50
    hidden
    items-center justify-center
    bg-black/70 backdrop-blur-md
">

    <div class="
        bg-white rounded-3xl p-8
        shadow-2xl
        text-center
        w-[90%] max-w-sm
    ">

        <p class="text-sm text-gray-500 mb-3">Escanea tu código</p>

        <div class="flex justify-center mb-4">
    {!! QrCode::size(240)->generate(url('/cliente/'.$cliente->qr_token)) !!}
</div>

        <button onclick="cerrarQR()" class="
            mt-2 px-4 py-2
            rounded-full
            bg-[#d29ba8]
            text-white text-sm
            hover:opacity-90
        ">
            Cerrar
        </button>

    </div>

</div>

@endsection