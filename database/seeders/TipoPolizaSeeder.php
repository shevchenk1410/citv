<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TipoPolizaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_poliza')->delete();
        DB::table('tipo_poliza')->insert([
            ['id'=>1, 'codigo' => 'SOAT', 'descripcion' => 'Seguro Obligatorio de Accidentes de Tránsito', 'estado'=>1],
            ['id'=>2, 'codigo' => 'AFOCAT', 'descripcion' => 'Asociaciones de Fondos Regionales o Provinciales contra Accidentes de Tránsito', 'estado'=>1],
        ]);
    }
}
