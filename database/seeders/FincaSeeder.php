<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FincaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fincas = [
        [
                'nombre'            => 'Finca Guasimales',
                'ubicacion'           => 'Vereda Cucharito San Jose de Miranda'

            ],
            [
                'nombre'            => 'Finca La Rinconada',
                'ubicacion'           => 'Vereda Cucharito San Jose de Miranda'

            ],
        ];

        //  insertar datos en la tabla
        DB::table('fincas')->insert($fincas);
    }
}
