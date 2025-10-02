<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoCosechaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define los estados clave de una cosecha
        $estados = [
            ['nombre' => 'Planificación'],
            ['nombre' => 'Siembra'],
            ['nombre' => 'Crecimiento Inicial'],
            ['nombre' => 'Floración'],
            ['nombre' => 'Desarrollo del Fruto'],
            ['nombre' => 'Maduración'],
            ['nombre' => 'Cosecha'],
            ['nombre' => 'Terminado'],
        ];

        // Inserta los datos en la tabla 'estadosCosecha'
        DB::table('estadosCosecha')->insert($estados);
    }
}
