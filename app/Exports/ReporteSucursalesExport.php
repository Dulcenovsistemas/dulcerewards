<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Exports\JornadasExport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Sucursal;

use App\Models\Cliente;
use App\Models\MovimientoPunto;
use App\Models\Jornada;

class ReporteSucursalesExport implements FromCollection, WithHeadings
{
    protected $inicio;
    protected $fin;

    public function __construct($inicio, $fin)
    {
        $this->inicio = $inicio;
        $this->fin = $fin;
    }

    public function collection()
    {
        return Sucursal::get()->map(function ($sucursal) {

            return [
                $sucursal->nombre,
                Cliente::where('sucursal_registro_id', $sucursal->id)->count(),
                MovimientoPunto::where('sucursal_id', $sucursal->id)
                    ->where('tipo', 'acumulado')
                    ->sum('puntos'),
                MovimientoPunto::where('sucursal_id', $sucursal->id)
                    ->where('tipo', 'canjeado')
                    ->count(),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Sucursal',
            'Clientes',
            'Puntos',
            'Canjes',
        ];
    }
}