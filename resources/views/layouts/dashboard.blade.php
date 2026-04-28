<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

    <body class="bg-gradient-to-br from-gray-900 via-gray-800 to-black min-h-screen">

        <main class="p-6">
             @if(session('success'))
        <div id="alert-success"
            class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 p-3 rounded-lg text-sm transition-opacity duration-500">
            
            {{ session('success') }}
        </div>
    @endif
            @yield('content')
        </main>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </body>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('alert-success');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000); // 3 segundos



        function abrirModal() {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modal').classList.add('flex');
        }

        function cerrarModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function mostrarTelefono() {
            document.getElementById('formTelefono').classList.remove('hidden');
        }

    </script>

</html>