<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\MovimientoPunto;
use App\Models\Premio;
use Carbon\Carbon;

class WalletController extends Controller
{
    public function show($token)
{
    $cliente = Cliente::where('qr_token', $token)
        ->with('sucursal')
        ->firstOrFail();

    $movimientosQuery = MovimientoPunto::where('cliente_id', $cliente->id);

    $puntos = $movimientosQuery->sum('puntos');

    $premios = Premio::where('activo', 1)
        ->orderBy('puntos_requeridos')
        ->get();

    $premioActual = $premios->firstWhere('puntos_requeridos', $puntos);

    $movimientos = $movimientosQuery->latest()->get();

    // 🔥 VIGENCIA
    $primerMovimiento = (clone $movimientosQuery)
        ->orderBy('created_at')
        ->first();

    $vigencia = null;
    $vigenciaVencida = false;
    $diasRestantes = null;

    if ($primerMovimiento) {
        $vigencia = Carbon::parse($primerMovimiento->created_at)->addYear();
        $vigenciaVencida = now()->greaterThan($vigencia);
        $diasRestantes = max(0, now()->diffInDays($vigencia, false));

        // 👉 si quieres reflejar vencimiento en UI
        if ($vigenciaVencida) {
            $puntos = 0;
        }
    }

    return view('wallet.show', compact(
        'cliente',
        'puntos',
        'premios',
        'premioActual',
        'movimientos',
        'vigencia',
        'vigenciaVencida',
        'diasRestantes'
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


    public function terminos($token)
    {
        $cliente = Cliente::where('qr_token', $token)->firstOrFail();

        return view('wallet.terminos', compact('cliente'));
    }
    
}
