<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'telefono',
        'fecha_nacimiento',
        'tipo_cliente',
        'empresa_nombre',
        'recibe_notificaciones',
        'qr_token',
        'sucursal_registro_id',
    ];


    protected static function booted()
    {
        static::creating(function ($cliente) {
            $cliente->qr_token = Str::uuid();
        });
    }

        public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_registro_id');
    }

    public function movimientos()
    {
        return $this->hasMany(MovimientoPunto::class);
    }
}
