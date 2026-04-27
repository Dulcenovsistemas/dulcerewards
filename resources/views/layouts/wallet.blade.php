<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 🔥 ESTE -->
    <title>Wallet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-[#1a0f14] via-[#2a1820] to-[#0b0b0f] text-white">

    @yield('content')



<script>
function abrirQR() {
    document.getElementById('qrModal').classList.remove('hidden');
    document.getElementById('qrModal').classList.add('flex');
}

function cerrarQR() {
    document.getElementById('qrModal').classList.add('hidden');
    document.getElementById('qrModal').classList.remove('flex');
}
</script>    

</body>
</html>