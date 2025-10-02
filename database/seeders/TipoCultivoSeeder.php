<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCultivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define un array con los datos iniciales (cultivos comunes)
        $tiposCultivo = [
            [
                'nombre' => 'Tomate',
                'cicloDias' => 90
            ],
            [
                'nombre' => 'Pimiento',
                'cicloDias' => 120
            ],
            [
                'nombre' => 'Lechuga',
                'cicloDias' => 45
            ],
        ];

        // Inserta los datos en la tabla 'tiposCultivo'
        DB::table('tiposCultivo')->insert($tiposCultivo);
    }



    
}
