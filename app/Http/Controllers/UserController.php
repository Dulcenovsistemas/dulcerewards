<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $users = User::with('sucursal')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sucursales = Sucursal::all();

        return view('users.create', compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'rol' => 'required',
            'sucursal_id' => 'required_if:rol,sucursal'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'sucursal_id' => $request->rol == 'admin'
                ? null
                : $request->sucursal_id
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $sucursales = Sucursal::all();

        return view('users.edit', compact('user', 'sucursales'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'rol' => 'required',
            'sucursal_id' => 'required_if:rol,sucursal'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol,
            'sucursal_id' => $request->rol == 'admin'
                ? null
                : $request->sucursal_id
        ];

        // Solo actualizar password si se envía
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(User $user)
    {
        // 🔒 Evitar que un usuario elimine a otro de otra sucursal
        if (
            auth()->user()->rol != 'admin' &&
            $user->sucursal_id != auth()->user()->sucursal_id
        ) {
            abort(403);
        }

        // 🔒 Evitar que se elimine a sí mismo
        if (auth()->id() == $user->id) {
            return back()->with('error', 'No puedes eliminar tu propio usuario');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}
