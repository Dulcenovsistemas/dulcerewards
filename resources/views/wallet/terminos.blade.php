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



    <!-- 📄 TÉRMINOS Y CONDICIONES -->
    <h1 class="text-xl font-semibold mt-10 mb-6">
        Términos y condiciones
    </h1>

    <div class="space-y-6 text-sm text-gray-300 leading-relaxed">

        <div>
            <h2 class="text-white font-medium mb-1">Participación</h2>
            <p>
                Este programa está dirigido únicamente a personas mayores de edad. El registro es personal e intransferible.
            </p>
        </div>

       <div>
            <h2 class="text-white font-medium mb-1">Acumulación de puntos</h2>
            <p>
                Los puntos se acumulan por producto participante, no por el monto total de la compra.
                Para registrarlos, es necesario proporcionar el número de teléfono al momento de la compra.
                No es posible agregar puntos de compras anteriores. Solo se registran puntos de compras hechas dentro de la misma ciudad, no se pueden registra compras en sucursales de diferentes ciudades.

                Los puntos tienen una vigencia de un año a partir de la fecha en que se registran por primera vez.
                Una vez transcurrido ese periodo, si no han sido canjeados, se eliminarán automáticamente y el conteo se reiniciará desde cero, tomando como nueva referencia la siguiente acumulación de puntos.
            </p>
        </div>

        <div>
            <h2 class="text-white font-medium mb-1">Canje de recompensas</h2>
           <p>
                Para canjear puntos, es obligatorio presentar el código QR del cliente junto con una identificación oficial vigente.
                No se realizarán canjes sin alguno de estos requisitos, ni en sucursales ubicadas en una ciudad distinta a la de registro.

                Los premios están sujetos a disponibilidad y no son canjeables por dinero en efectivo.
            </p>
        </div>

        <div>
            <h2 class="text-white font-medium mb-1">Uso indebido</h2>
            <p>
                Cualquier uso indebido, intento de fraude o manipulación del sistema podrá resultar en la cancelación de la cuenta y pérdida de puntos.
            </p>
        </div>

        <div>
            <h2 class="text-white font-medium mb-1">Modificaciones</h2>
            <p>
                Dulce Noviembre se reserva el derecho de modificar estos términos y condiciones en cualquier momento.
            </p>
        </div>

        <p class="text-xs text-gray-500 pt-4">
            Última actualización: Abril 2026
        </p>

    </div>

</div>

@endsection