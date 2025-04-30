<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoAmbitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('tipo_ambito')->delete();
        DB::table('tipo_ambito')->insert([
            ['codigo' => 0, 'descripcion' => 'Ninguno', 'estado' => 1],
            ['codigo' => 1, 'descripcion' => 'Ambito Nacional', 'estado' => 1],
            ['codigo' => 2, 'descripcion' => 'Ambito Regional', 'estado' => 1],
            ['codigo' => 3, 'descripcion' => 'Ambito Provincial', 'estado' => 1],
            ['codigo' => 4, 'descripcion' => 'Ambito Internacional (Pasajeros)', 'estado' => 1],
            ['codigo' => 5, 'descripcion' => 'Ambito Distrital', 'estado' => 1],
        ]);
    }
}
