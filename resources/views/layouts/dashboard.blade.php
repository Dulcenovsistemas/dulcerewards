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

    <!-- LIBRERÍA QR -->
    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        // ALERTA AUTO OCULTAR
        setTimeout(() => {
            const alert = document.getElementById('alert-success');
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);

        // MODAL
        function abrirModal() {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modal').classList.add('flex');
        }

        function cerrarModal() {
            document.getElementById('modal').classList.add('hidden');

            const reader = document.getElementById('qr-reader');

            if (html5QrCode && scannerActivo) {
                html5QrCode.stop().catch(() => {});
                scannerActivo = false;
            }

            // ocultar visor
            if (reader) {
                reader.classList.add('hidden');
                reader.innerHTML = "";
            }
        }

        function mostrarTelefono() {
            document.getElementById('formTelefono').classList.remove('hidden');
        }

        // =========================
        // 🔥 SCANNER QR
        // =========================
        let html5QrCode;
        let scannerActivo = false;

        function iniciarScanner() {
    const reader = document.getElementById('qr-reader');
    const formTelefono = document.getElementById('formTelefono');

    // ocultar teléfono
    if (formTelefono) {
        formTelefono.classList.add('hidden');
    }

    reader.classList.remove('hidden');

    if (!html5QrCode) {
        html5QrCode = new Html5Qrcode("qr-reader");
    }

    if (scannerActivo) return;

    html5QrCode.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: 250
        },
        (decodedText) => {
            html5QrCode.stop().then(() => {
                scannerActivo = false;

                alert("Cliente detectado ✔️");

                procesarQR(decodedText);
            });
        }
    ).then(() => {
        scannerActivo = true;
    });
}

        function procesarQR(data) {
            // Validar formato esperado
            if (!data.includes('/cliente/')) {
                alert('QR inválido');
                return;
            }

            let token = data.split('/').pop();

            if (!token) {
                alert('QR inválido');
                return;
            }

            // Redirigir
            window.location.href = `/movimientos/crear/${token}`;
        }

        // =========================
// 🔥 SCANNER CANJE
// =========================
let html5QrCanje;
let scannerCanjeActivo = false;
let clienteCanjeId = null;

function abrirScannerCanje(clienteId) {
    clienteCanjeId = clienteId;

    const modal = document.getElementById('modalCanje');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    if (!html5QrCanje) {
        html5QrCanje = new Html5Qrcode("qr-reader-canje");
    }

    if (scannerCanjeActivo) return;

    html5QrCanje.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 250 },
        (decodedText) => {
            html5QrCanje.stop().then(() => {
                scannerCanjeActivo = false;
                validarCanje(decodedText);
            });
        }
    ).then(() => {
        scannerCanjeActivo = true;
    }).catch(err => {
        console.error('Error cámara canje:', err);
    });
}

function cerrarModalCanje() {
    const modal = document.getElementById('modalCanje');
    modal.classList.add('hidden');

    if (html5QrCanje && scannerCanjeActivo) {
        html5QrCanje.stop().catch(() => {});
        scannerCanjeActivo = false;
    }

    const reader = document.getElementById('qr-reader-canje');
    if (reader) reader.innerHTML = "";
}

function validarCanje(data) {
    if (!data.includes('/cliente/')) {
        alert('QR inválido');
        return;
    }

    const token = data.split('/').pop();
    if (!token) {
        alert('QR inválido');
        return;
    }

    // valida contra backend
    fetch(`/validar-cliente/${token}`)
        .then(res => res.json())
        .then(cliente => {
            if (!cliente || cliente.id != clienteCanjeId) {
                alert('Este QR no corresponde al cliente');
                return;
            }

            if (confirm(`¿Confirmar canje para ${cliente.nombre}?`)) {
                realizarCanje(cliente.id);
            }
        })
        .catch(() => alert('Error al validar cliente'));
}

function realizarCanje(clienteId) {
    fetch("{{ route('canjear') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            cliente_id: clienteId,
            sucursal_id: {{ auth()->user()->sucursal_id }}
        })
    })
    .then(res => {
        if (!res.ok) throw new Error();
        return res.json();
    })
    .then(() => {
        alert("Canje realizado ✔️");
        location.reload();
    })
    .catch(() => {
        alert('Error al realizar canje');
    });
}
    </script>

</body>
</html>