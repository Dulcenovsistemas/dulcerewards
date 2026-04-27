<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $fillable = [
        'cliente_id',
        'movimiento_id',
        'sucursal_id',
        'calificacion',
    ];
}
