
<?php

  namespace Database\Seeders;


    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;


    class InvernaderoSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $invernaderos=[
                    [
                    'nombre' => 'El Tomatero',
                    'tamaño' => '9000',
                    'costoConstruccion' => 80000000,
                    'rendimiento' => '0',
                    'idFinca' => 1
                ],
                [
                    'nombre' => 'El Origen',
                    'tamaño' => '10000',
                    'costoConstruccion' => 10000000,
                    'rendimiento' => '0',
                    'idFinca' => 1
                ],
                [
                    'nombre' => 'El Rincon',
                    'tamaño' => '15000',
                    'costoConstruccion' => 120000000,
                    'rendimiento' => '0',
                    'idFinca' => 2
                ],
                
            ];
            DB::table('invernaderos')->insert($invernaderos);
        }
    }
