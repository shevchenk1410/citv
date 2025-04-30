<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoInspeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_inspeccion')->delete();
        DB::table('tipo_inspeccion')->insert([
            ['codigo' => 1, 'descripcion' => 'Ordinaria', 'estado' => 1],
            ['codigo' => 2, 'descripcion' => 'Ordinaria y complementaria', 'estado' => 1],
            ['codigo' => 3, 'descripcion' => 'Extraordinaria', 'estado' => 1],
            ['codigo' => 4, 'descripcion' => 'Incorporación', 'estado' => 1],
            ['codigo' => 5, 'descripcion' => 'Complementaria', 'estado' => 1],
        ]);
    }
}
