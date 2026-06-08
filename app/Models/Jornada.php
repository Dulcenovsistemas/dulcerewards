<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    protected $fillable = [
        'folio',
        'usuario_id',
        'sucursal_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',
        'observaciones'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function movimientos()
    {
        return $this->hasMany(MovimientoPunto::class);
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}