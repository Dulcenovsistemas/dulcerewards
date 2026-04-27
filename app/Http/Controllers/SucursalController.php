<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sucursal;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sucursales = Sucursal::all();
        return view('sucursales.index', compact('sucursales'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'ciudad' => 'nullable',
            'direccion' => 'nullable',
        ]);

        Sucursal::create($request->all());

        return redirect()->route('sucursales.index')
            ->with('success', 'Sucursal creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sucursal = Sucursal::findOrFail($id);

        return view('sucursales.edit', compact('sucursal'));
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, Sucursal $sucursal)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $sucursal->update($request->only([
            'nombre',
            'ciudad',
            'direccion'
        ]));

        return redirect()->route('sucursales.index')
            ->with('success', 'Sucursal actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sucursal = Sucursal::findOrFail($id);

        $sucursal->delete();

        return redirect()->route('sucursales.index')
            ->with('success', 'Sucursal eliminada');
    }
}
