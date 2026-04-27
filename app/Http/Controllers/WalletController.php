<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\MovimientoPunto;
use App\Models\Premio;

class WalletController extends Controller
{
    public function show($token)
    {
        $cliente = Cliente::where('qr_token', $token)
            ->with('sucursal')
            ->firstOrFail();

        $puntos = MovimientoPunto::where('cliente_id', $cliente->id)->sum('puntos');

        $premios = Premio::where('activo', 1)
            ->orderBy('puntos_requeridos')
            ->get();

        $premioActual = $premios->firstWhere('puntos_requeridos', $puntos);

        $movimientos = MovimientoPunto::where('cliente_id', $cliente->id)
            ->latest()
            ->get();

        return view('wallet.show', compact(
            'cliente',
            'puntos',
            'premios',
            'premioActual',
            'movimientos'
        ));
    }

     public function perfil($token)
    {
        $cliente = Cliente::where('qr_token', $token)->firstOrFail();

        return view('wallet.perfil', compact('cliente'));
    }

    public function ayuda($token)
    {
        $cliente = Cliente::where('qr_token', $token)->firstOrFail();

        return view('wallet.ayuda', compact('cliente'));
    }

    public function privacidad($token)
    {
        $cliente = Cliente::where('qr_token', $token)->firstOrFail();

        return view('wallet.privacidad', compact('cliente'));
    }

    
}
