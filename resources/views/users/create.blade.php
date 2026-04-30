@extends('layouts.dashboard')

@section('title', 'Nuevo Usuario')

@section('content')

<div class="relative max-w-2xl mx-auto">

    <!-- Glow -->
    <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[400px] h-[400px] bg-pink-500/10 blur-[120px] pointer-events-none"></div>

    <!-- HEADER -->
    <div class="mb-8 relative z-10">
        <h1 class="text-2xl text-white font-bold">Nuevo Usuario</h1>
        <p class="text-sm text-gray-400">
            Crea un usuario y define su nivel de acceso dentro de Dulce Rewards
        </p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 shadow-2xl relative z-10">

        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre</label>
                <input type="text" name="name"
                    value="{{ old('name') }}"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="Ej. Juan Pérez"
                    required>

                @error('name')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Correo electrónico</label>
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="ejemplo@correo.com"
                    required>

                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Contraseña</label>
                <input type="password" name="password"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition"
                    placeholder="••••••••"
                    required>

                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ROL -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Rol</label>

                <select name="rol" id="rol"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition">

                    <option value="admin">Administrador</option>
                    <option value="sucursal">Usuario de sucursal</option>

                </select>

                <p class="text-xs text-gray-500 mt-1">
                    Define si el usuario tendrá acceso completo o solo a una sucursal.
                </p>

                @error('rol')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SUCURSAL -->
            <div id="sucursal-container">
                <label class="block text-sm text-gray-300 mb-1">Sucursal</label>

                <select name="sucursal_id"
                    class="w-full bg-white/10 border border-white/10 text-white px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 transition">

                    <option value="">Seleccionar sucursal</option>

                    @foreach($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}">
                            {{ $sucursal->nombre }}
                        </option>
                    @endforeach

                </select>

                @error('sucursal_id')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- BOTONES -->
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('users.index') }}"
                   class="px-4 py-2 text-gray-300 hover:bg-white/10 rounded-lg transition">
                    Cancelar
                </a>

                <button
                    class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2.5 rounded-xl text-sm font-medium transition shadow-lg shadow-pink-500/30 hover:scale-105">
                    Crear usuario
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