<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ClientesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $clientes;

    public function __construct(Collection $clientes)
    {
        $this->clientes = $clientes;
    }

    public function collection()
    {
        return $this->clientes;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Teléfono',
            'Correo',
            'Fecha de nacimiento',
            'Tipo de cliente',
            'Empresa',
            'Sucursal',
            'Ciudad',
            'Fecha de registro',
        ];
    }

    public function map($cliente): array
    {
        return [
            $cliente->id,
            $cliente->nombre,
            $cliente->telefono,
            $cliente->email,
            $cliente->fecha_nacimiento,
            $cliente->tipo_cliente,
            $cliente->empresa_nombre,
            $cliente->sucursal->nombre ?? '',
            $cliente->sucursal->ciudad ?? '',
            $cliente->created_at?->format('d/m/Y H:i'),
        ];
    }
}
