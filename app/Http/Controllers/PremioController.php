<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Premio;
use App\Models\Sucursal;


class PremioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $premios = Premio::latest()->get();

        return view('premios.index', compact('premios'));
    }

    
    public function create()
    {
        $sucursales = Sucursal::all();

        return view('premios.create', compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'puntos_requeridos' => 'required|integer|min:1',
        ]);

        Premio::create([
            'nombre' => $request->nombre,
            'puntos_requeridos' => $request->puntos_requeridos,
            'ciudad' => $request->ciudad,
            'activo' => $request->has('activo'),
        ]);

        return redirect()->route('premios.index')
            ->with('success', 'Premio creado correctamente 🎉');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Premio $premio)
    {
        $sucursales = Sucursal::all();

        return view('premios.edit', compact('premio', 'sucursales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Premio $premio)
    {
        $request->validate([
            'nombre' => 'required',
            'puntos_requeridos' => 'required|integer|min:1',
        ]);

        $premio->update([
            'nombre' => $request->nombre,
            'puntos_requeridos' => $request->puntos_requeridos,
            'ciudad' => $request->ciudad,
            'activo' => $request->has('activo'),
        ]);

        return redirect()->route('premios.index')
            ->with('success', 'Premio actualizado correctamente ✨');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Premio $premio)
    {
        $premio->delete();

        return redirect()->route('premios.index')
            ->with('success', 'Premio eliminado correctamente 🗑️');
    }
}
