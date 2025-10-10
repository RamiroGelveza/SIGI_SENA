<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(TipoCultivoSeeder::class);
        $this->call(EstadoCosechaSeeder::class);
        $this->call(CategoriaGastoSeeder::class);
        $this->call(FincaSeeder::class);
        $this->call(InvernaderoSeeder::class);



    }
}
