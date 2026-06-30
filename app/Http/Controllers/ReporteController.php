<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\ReporteSucursalesExport;
use Maatwebsite\Excel\Facades\Excel;


use App\Exports\JornadasExport;
use App\Models\Sucursal;

use App\Models\Cliente;
use App\Models\MovimientoPunto;
use App\Models\Jornada;

class ReporteController extends Controller                                  
{

    public function index(Request $request)
{
    $inicio = $request->fecha_inicio;
    $fin = $request->fecha_fin;

    // Si es administrador ve todas las sucursales,
    // de lo contrario solo la que tiene asignada.
    if (auth()->user()->is_admin) {
        $sucursales = Sucursal::all();
    } else {
        $sucursales = collect([auth()->user()->sucursal]);
    }

    $reporte = $sucursales->map(function ($sucursal) use ($inicio, $fin) {

        $clientes = Cliente::where(
            'sucursal_registro_id',
            $sucursal->id
        );

        $puntos = MovimientoPunto::where(
            'sucursal_id',
            $sucursal->id
        )->where('tipo', 'acumulado');

        $canjes = MovimientoPunto::where(
            'sucursal_id',
            $sucursal->id
        )->where('tipo', 'canjeado');

        if ($inicio && $fin) {

            $clientes->whereBetween('created_at', [
                $inicio . ' 00:00:00',
                $fin . ' 23:59:59'
            ]);

            $puntos->whereBetween('created_at', [
                $inicio . ' 00:00:00',
                $fin . ' 23:59:59'
            ]);

            $canjes->whereBetween('created_at', [
                $inicio . ' 00:00:00',
                $fin . ' 23:59:59'
            ]);
        }

        return [
            'nombre' => $sucursal->nombre,
            'clientes' => $clientes->count(),
            'puntos' => $puntos->sum('puntos'),
            'canjes' => $canjes->count(),
        ];
    });

    $totalClientes = $reporte->sum('clientes');
    $totalPuntos = $reporte->sum('puntos');
    $totalCanjes = $reporte->sum('canjes');

    return view('reportes.index', compact(
        'reporte',
        'totalClientes',
        'totalPuntos',
        'totalCanjes'
    ));
}

    public function jornadas()
    {
        return Excel::download(
            new JornadasExport,
            'jornadas.xlsx'
        );
    }

    public function exportar(Request $request)
    {
        return Excel::download(
            new ReporteSucursalesExport(
                $request->fecha_inicio,
                $request->fecha_fin
            ),
            'reporte-sucursales.xlsx'
        );
    }
}
