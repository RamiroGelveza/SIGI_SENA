<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaGastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define categorías de gastos más detalladas para la gestión agrícola.
        $categorias = [
            // GASTOS DE INSUMOS
            ['nombre' => 'Semillas y Plántulas'],
            ['nombre' => 'Sustratos y Tierra'],
            ['nombre' => 'Fertilizantes (Químicos)'],
            ['nombre' => 'Fertilizantes (Orgánicos)'],
            ['nombre' => 'Pesticidas y Fungicidas'],
            ['nombre' => 'Herbicidas'],
            ['nombre' => 'Materiales de Embalaje (Cosecha)'],

            // GASTOS DE OPERACIÓN E INFRAESTRUCTURA
            ['nombre' => 'Salarios y Beneficios (Mano de Obra)'],
            ['nombre' => 'Reparación y Mantenimiento de Maquinaria'],
            ['nombre' => 'Mantenimiento de Infraestructura (Invernaderos)'],
            ['nombre' => 'Combustible y Lubricantes (Maquinaria)'],
            ['nombre' => 'Servicios Públicos (Electricidad, Gas)'],
            ['nombre' => 'Consumo de Agua y Tarifas de Riego'],

            // GASTOS ADMINISTRATIVOS Y FINANCIEROS
            ['nombre' => 'Seguros Agrícolas'],
            ['nombre' => 'Impuestos y Licencias'],
            ['nombre' => 'Asesoría Técnica (Agrónomo)'],
            ['nombre' => 'Renta de Tierras y Equipos'],
            ['nombre' => 'Transporte (Venta y Entrega)'],
        ];

        // Inserta los datos en la tabla 'categoriaGastos'
        DB::table('categoriaGastos')->insert($categorias);
    }
}
