@extends('layouts.dashboard')

@section('title', 'Editar Usuario')

@section('content')

<div class="relative max-w-2xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[400px] h-[400px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="mb-8 relative z-10 flex items-center gap-4">

        <div class="w-12 h-12 rounded-full bg-pink-500/20 flex items-center justify-center text-pink-300 font-semibold">
            {{ strtoupper(substr($user->name, 0, 2)) }}
        </div>

        <div>
            <h1 class="text-2xl text-white font-bold">Editar Usuario</h1>
            <p class="text-sm text-gray-400">
                Actualiza la información y permisos de este usuario
            </p>
        </div>

    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl relative z-10">

        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre</label>
                <input type="text" name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    required>
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Correo electrónico</label>
                <input type="email" name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    required>
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nueva contraseña</label>
                <input type="password" name="password"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="Dejar vacío para mantener la actual">

                <p class="text-xs text-gray-500 mt-1">
                    Solo completa este campo si deseas cambiar la contraseña.
                </p>
            </div>

            <!-- ROL -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Rol</label>

                <select name="rol" id="rol"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition">

                    <option value="admin" {{ $user->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="sucursal" {{ $user->rol == 'sucursal' ? 'selected' : '' }}>Usuario de sucursal</option>

                </select>
            </div>

            <!-- SUCURSAL -->
            <div id="sucursal-container">
                <label class="block text-sm text-gray-300 mb-1">Sucursal</label>

                <select name="sucursal_id"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition">

                    <option value="">Seleccionar sucursal</option>

                    @foreach($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}"
                            {{ $user->sucursal_id == $sucursal->id ? 'selected' : '' }}>
                            {{ $sucursal->nombre }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('users.index') }}"
                   class="px-4 py-2 text-gray-300 hover:bg-white/10 rounded-lg transition">
                    Cancelar
                </a>

                <button
                    class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-lg shadow-pink-500/30 hover:scale-105">
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

</div>

<!-- SCRIPT -->
<script>
    const rol = document.getElementById('rol');
    const sucursalContainer = document.getElementById('sucursal-container');

    function toggleSucursal() {
        if (rol.value === 'admin') {
            sucursalContainer.style.display = 'none';
        } else {
            sucursalContainer.style.display = 'block';
        }
    }

    rol.addEventListener('change', toggleSucursal);
    toggleSucursal();
</script>

@endsection