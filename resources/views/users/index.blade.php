@extends('layouts.dashboard')

@section('title', 'Usuarios')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl text-white font-semibold">Usuarios</h1>
            <p class="text-sm text-gray-400">Administra los usuarios del sistema</p>
        </div>

        <a href="{{ route('users.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            + Nuevo usuario
        </a>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Total usuarios</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $users->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Admins</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $users->where('rol','admin')->count() }}
            </h3>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-5">
            <p class="text-gray-400 text-sm">Usuarios sucursal</p>
            <h3 class="text-white text-2xl font-semibold">
                {{ $users->where('rol','sucursal')->count() }}
            </h3>
        </div>

    </div>

    <!-- TABLA -->
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden">

        <div class="max-h-[60vh] overflow-y-auto">

            <table class="w-full text-sm text-gray-300">

                <!-- HEADER -->
                <thead class="border-b border-white/10 text-gray-400 text-xs uppercase bg-black/20 backdrop-blur sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-4 text-left">Usuario</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Rol</th>
                        <th class="px-6 py-4 text-left">Sucursal</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-white/5">

                    @forelse($users as $user)
                    <tr class="hover:bg-white/5 transition">

                        <!-- USUARIO -->
                        <td class="px-6 py-4 flex items-center gap-3">

                            <div class="w-9 h-9 rounded-full bg-blue-500/20 flex items-center justify-center text-xs text-blue-300 font-semibold">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>

                            <div>
                                <p class="text-white font-medium">
                                    {{ $user->name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    ID: {{ $user->id }}
                                </p>
                            </div>

                        </td>

                        <!-- EMAIL -->
                        <td class="px-6 py-4 text-gray-400">
                            {{ $user->email }}
                        </td>

                        <!-- ROL -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full
                                {{ $user->rol == 'admin'
                                    ? 'bg-blue-500/20 text-blue-400'
                                    : 'bg-green-500/20 text-green-400' }}">
                                {{ ucfirst($user->rol) }}
                            </span>
                        </td>

                        <!-- SUCURSAL -->
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs bg-white/10 rounded-full text-gray-300">
                                {{ $user->sucursal->nombre ?? '—' }}
                            </span>
                        </td>

                        <!-- ACCIONES -->
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4 text-gray-400">


                                <!-- Ver -->
                                <a href="{{ route('users.show', $user) }}" class="hover:text-white transition"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>

                                <!-- Editar -->
                                <a href="{{ route('users.edit', $user) }}"
                                   class="hover:text-blue-400 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                </a>

                                <!-- Eliminar -->
                                <form method="POST" action="{{ route('users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('¿Eliminar usuario?')"
                                            class="hover:text-red-400 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                            </svg>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            No hay usuarios registrados
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

     <!-- LOGOUT -->
        <button
            onclick="event.preventDefault(); if(confirm('¿Cerrar sesión?')) document.getElementById('logout-form').submit();"
            class="fixed bottom-6 right-24 bg-red-600 hover:bg-red-700 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-xl transition">

            <i class="bi bi-box-arrow-right text-[20px] leading-none"></i>

        </button>

        <!-- HOME -->
        <a href="{{ route('dashboard') }}"
        class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white w-14 h-14 flex items-center justify-center rounded-full shadow-xl transition">

            <i class="bi bi-house text-[20px] leading-none"></i>

        </a>

</div>

@endsection