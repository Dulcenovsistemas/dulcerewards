<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sucursal;


class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sucursal::create([
            'nombre' => 'Suc Dulce Noviembre Cafè',
            'ciudad' => 'Cuauhtèmoc'
        ]);

        Sucursal::create([
            'nombre' => 'Suc Dulce Noviembre Rio Grande',
            'ciudad' => 'Juárez'
        ]);

        Sucursal::create([
            'nombre' => 'Suc Dulce Noviembre Americas',
            'ciudad' => 'Chihuahua'
        ]);
    }
}
