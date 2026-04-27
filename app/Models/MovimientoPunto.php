<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoPunto extends Model
{

        protected $table = 'movimientos_puntos';

        protected $fillable = [
        'cliente_id',
        'sucursal_id',
        'usuario_id',
        'ciudad',
        'puntos',
        'tipo',
        'descripcion',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
