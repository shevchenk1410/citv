<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivoAnulacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('motivo_anulacion')->delete();
        DB::table('motivo_anulacion')->insert([
            ['codigo' => 1, 'descripcion' => 'Error digitación u Omisión', 'estado'=>1],
            ['codigo' => 2, 'descripcion' => 'Error de impresión de documento', 'estado'=>1],
            ['codigo' => 3, 'descripcion' => 'Error de Operación', 'estado'=>1],
            ['codigo' => 4, 'descripcion' => 'Pérdida o Robo', 'estado'=>1],
            ['codigo' => 5, 'descripcion' => 'Deterioro', 'estado'=>1],
        ]);
    }
}
