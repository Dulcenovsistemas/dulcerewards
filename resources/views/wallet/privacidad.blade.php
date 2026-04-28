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

    <h1 class="text-xl font-semibold mb-6">
        Aviso de privacidad
    </h1>

    <div class="space-y-6 text-sm text-gray-300 leading-relaxed">

        <p>
            En <span class="text-white font-medium">Dulce Noviembre</span>, nos comprometemos a proteger tus datos personales.
        </p>

        <div>
            <h2 class="text-white font-medium mb-1">Datos que recopilamos</h2>
            <p>
                Nombre, número telefónico y datos relacionados con tus compras y puntos acumulados.
            </p>
        </div>

        <div>
            <h2 class="text-white font-medium mb-1">Uso de la información</h2>
            <p>
                Utilizamos tu información para administrar tu cuenta, asignar puntos, ofrecer recompensas y mejorar nuestro servicio.
            </p>
        </div>

        <div>
            <h2 class="text-white font-medium mb-1">Protección de datos</h2>
            <p>
                Tus datos son almacenados de forma segura y no se comparten con terceros sin tu consentimiento.
            </p>
        </div>

        <div>
            <h2 class="text-white font-medium mb-1">Derechos ARCO</h2>
            <p>
                Puedes acceder, rectificar o cancelar tus datos personales en cualquier momento contactándonos.
            </p>
        </div>

        <div>
            <h2 class="text-white font-medium mb-1">Contacto</h2>
            <p>
                Para cualquier duda sobre este aviso, puedes comunicarte a través de nuestros canales oficiales.
            </p>
        </div>

        <p class="text-xs text-gray-500 pt-4">
            Última actualización: Abril 2026
        </p>

    </div>

</div>

@endsection