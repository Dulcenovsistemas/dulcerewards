@extends('layouts.dashboard')

@section('title', 'Editar Usuario')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-xl text-white font-semibold">Editar Usuario</h1>
        <p class="text-sm text-gray-400">Modifica la información del usuario</p>
    </div>

    <!-- CARD -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">

        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- NOMBRE -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre</label>
                <input type="text" name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg"
                    required>
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Email</label>
                <input type="email" name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg"
                    required>
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nueva contraseña</label>
                <input type="password" name="password"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg"
                    placeholder="Opcional">
            </div>

            <!-- ROL -->
            <div>
                <label class="block text-sm text-gray-300 mb-1">Rol</label>

                <select name="rol" id="rol"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg">

                    <option value="admin" {{ $user->rol == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="sucursal" {{ $user->rol == 'sucursal' ? 'selected' : '' }}>Sucursal</option>

                </select>
            </div>

            <!-- SUCURSAL -->
            <div id="sucursal-container">
                <label class="block text-sm text-gray-300 mb-1">Sucursal</label>

                <select name="sucursal_id"
                    class="w-full bg-white/5 border border-white/10 text-white px-4 py-2.5 rounded-lg">

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
                   class="px-4 py-2 text-gray-300 hover:bg-white/10 rounded-lg">
                    Cancelar
                </a>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Actualizar
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