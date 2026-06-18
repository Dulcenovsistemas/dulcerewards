<?php

namespace App\Exports;

use App\Models\Jornada;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JornadasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Jornada::with(['sucursal', 'usuario'])
            ->get()
            ->map(function ($jornada) {
                return [
                    'folio'      => $jornada->folio,
                    'fecha'      => $jornada->fecha,
                    'sucursal'   => $jornada->sucursal->nombre ?? '',
                    'usuario'    => $jornada->usuario->name ?? '',
                    'estado'     => $jornada->estado,
                    'inicio'     => $jornada->hora_inicio,
                    'fin'        => $jornada->hora_fin,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Folio',
            'Fecha',
            'Sucursal',
            'Usuario',
            'Estado',
            'Hora Inicio',
            'Hora Fin',
        ];
    }
}