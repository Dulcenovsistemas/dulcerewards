@extends('layouts.wallet')

@section('content')

<div class="min-h-screen px-4 py-6 text-white">
    <!-- 🔙 BOTÓN VOLVER -->
    <button onclick="goBack()" class="
        w-10 h-10 flex items-center justify-center
        rounded-full
        bg-white/5
        border border-white/10
        hover:bg-white/10
        transition
    ">
        <i class="bi bi-arrow-left text-white text-lg"></i>
    </button>
    <br>

    <h1 class="text-xl font-semibold mb-6">Centro de ayuda</h1>

    <!-- ❓ FAQ -->
    <div class="mb-6">
    <h2 class="text-sm text-gray-400 mb-3">Preguntas frecuentes</h2>

    <div class="space-y-3">

        <!-- ITEM -->
        <div class="bg-white/5 rounded-xl overflow-hidden">
            <button onclick="toggleFAQ(this)" class="w-full text-left p-4 flex justify-between items-center">
                <span>¿Cómo acumulo puntos?</span>
                <i class="bi bi-chevron-down transition-transform"></i>
            </button>

            <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 px-4">
                <p class="text-sm text-gray-400 pb-4">
                    Acumula puntos en cada compra escaneando tu QR o proporcionando tu número. Los puntos se asignan por cada producto participante: pasteles grandes, chicos, flan y cheesecake.
                </p>
            </div>
        </div>

        <!-- ITEM -->
        <div class="bg-white/5 rounded-xl overflow-hidden">
            <button onclick="toggleFAQ(this)" class="w-full text-left p-4 flex justify-between items-center">
                <span>¿Cómo canjeo premios?</span>
                <i class="bi bi-chevron-down transition-transform"></i>
            </button>

            <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 px-4">
                <p class="text-sm text-gray-400 pb-4">
                    Cuando tengas los puntos necesarios, puedes solicitarlos en sucursal.
                </p>
            </div>
        </div>

         <!-- ITEM -->
        <div class="bg-white/5 rounded-xl overflow-hidden">
            <button onclick="toggleFAQ(this)" class="w-full text-left p-4 flex justify-between items-center">
                <span>¿Que productos no aplican para puntos?</span>
                <i class="bi bi-chevron-down transition-transform"></i>
            </button>

            <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 px-4">
                <p class="text-sm text-gray-400 pb-4">
                    No aplican pasteles minis, macarons .
                </p>
            </div>
        </div>

    </div>
</div>

    <!-- 📄 LEGALES -->
    <div class="space-y-3">

        <a href="{{ route('terminos', $cliente->qr_token) }}"  
        class="block bg-white/5 p-4 rounded-xl">
            Términos y condiciones
        </a>

        <a href="{{ route('privacidad', $cliente->qr_token) }}" 
        class="block bg-white/5 p-4 rounded-xl">
            Aviso de privacidad
        </a>

    </div>

</div>

@endsection