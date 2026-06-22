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

        if ($this->inicio && $this->fin) {

            $clientes->whereBetween('created_at', [
                $this->inicio . ' 00:00:00',
                $this->fin . ' 23:59:59'
            ]);

            $puntos->whereBetween('created_at', [
                $this->inicio . ' 00:00:00',
                $this->fin . ' 23:59:59'
            ]);

            $canjes->whereBetween('created_at', [
                $this->inicio . ' 00:00:00',
                $this->fin . ' 23:59:59'
            ]);
        }

        return [
            $sucursal->nombre,
            $clientes->count(),
            $puntos->sum('puntos'),
            $canjes->count(),
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