<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jornada;
use App\Models\Sucursal;
use App\Models\Cliente;
use App\Models\MovimientoPunto;
use Illuminate\Support\Str;

class JornadaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jornadas = Jornada::with(['usuario', 'sucursal'])
            ->latest('fecha')
            ->latest('id')
            ->paginate(15);

        return view('jornadas.index', compact('jornadas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sucursales = Sucursal::orderBy('nombre')->get();

        return view('jornadas.create', compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sucursal_id' => 'required|exists:sucursales,id',
            'fecha' => 'required|date',
            'observaciones' => 'nullable|string|max:500',
        ]);

        $abierta = Jornada::where('sucursal_id', $request->sucursal_id)
            ->where('estado', 'abierta')
            ->exists();

        if ($abierta) {
            return back()->withInput()
                ->with('error', 'Ya existe una jornada abierta para esta sucursal.');
        }

        $jornada = Jornada::create([
            'folio' => 'TEMP',
            'usuario_id' => auth()->id(),
            'sucursal_id' => $request->sucursal_id,
            'fecha' => $request->fecha,
            'hora_inicio' => now(),
            'estado' => 'abierta',
            'observaciones' => $request->observaciones,
        ]);

        $jornada->update([
            'folio' => 'JOR-' . str_pad($jornada->id, 6, '0', STR_PAD_LEFT)
        ]);

        return redirect()
            ->route('jornadas.edit', $jornada)
            ->with('success', 'Jornada creada correctamente.');
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
    public function edit(Jornada $jornada)
    {
        $clientes = Cliente::all();

        $movimientos = MovimientoPunto::with([
            'cliente',
            'sucursal'
        ])
        ->where('jornada_id', $jornada->id)
        ->latest()
        ->get();

        $sucursales = Sucursal::all();

        $clientesJornada = Cliente::where('jornada_id', $jornada->id)
        ->latest()
        ->get();

        return view('jornadas.edit', compact(
            'jornada',
            'clientes',
            'movimientos',
            'sucursales',
            'clientesJornada'
        ));
    }

    public function cerrar(Jornada $jornada)
    {
        $jornada->update([
            'estado' => 'cerrada',
            'hora_fin' => now(),
        ]);

        return back()->with(
            'success',
            'Jornada cerrada correctamente.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
