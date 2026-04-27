@extends('layouts.dashboard')

@section('title', 'Nuevo Usuario')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-xl text-white font-semibold">Nuevo Usuario</h1>
        <p class="text-sm text-gray-400">Crea un nuevo usuario en el sistema</p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">

        <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre</label>
                <input type="text" name="name"
                    value="{{ old('name') }}"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500"
                    required>

                @error('name')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Email</label>
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500"
                    required>

                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Contraseña</label>
                <input type="password" name="password"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500"
                    required>

                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ROL -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Rol</label>

                <select name="rol" id="rol"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500">

                    <option value="admin">Admin</option>
                    <option value="sucursal">Sucursal</option>

                </select>

                @error('rol')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SUCURSAL -->
            <div id="sucursal-container">
                <label class="block text-sm text-gray-300 mb-1">Sucursal</label>

                <select name="sucursal_id"
                    class="w-full bg-white/5 border border-white/10 text-black px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-blue-500">

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
                   class="px-4 py-2 text-gray-300 hover:bg-white/10 rounded-lg">
                    Cancelar
                </a>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium">
                    Guardar
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

    // ejecutar al cargar
    toggleSucursal();
</script>

@endsection