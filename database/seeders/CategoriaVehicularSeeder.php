<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaVehicularSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categoria_vehicular')->delete();
        DB::table('categoria_vehicular')->insert([
            [ 'codigo' => 1, 'descripcion' => 'M1', 'estado' => 1 ],
            [ 'codigo' => 2, 'descripcion' => 'M2', 'estado' => 1 ],
            [ 'codigo' => 3, 'descripcion' => 'M3', 'estado' => 1 ],
            [ 'codigo' => 4, 'descripcion' => 'N1', 'estado' => 1 ],
            [ 'codigo' => 5, 'descripcion' => 'N2', 'estado' => 1 ],
            [ 'codigo' => 6, 'descripcion' => 'N3', 'estado' => 1 ],
            [ 'codigo' => 7, 'descripcion' => 'O1', 'estado' => 1 ],
            [ 'codigo' => 8, 'descripcion' => 'O2', 'estado' => 1 ],
            [ 'codigo' => 9, 'descripcion' => 'O3', 'estado' => 1 ],
            [ 'codigo' => 10, 'descripcion' => 'O4', 'estado' => 1 ],
            [ 'codigo' => 11, 'descripcion' => 'L1', 'estado' => 1 ],
            [ 'codigo' => 12, 'descripcion' => 'L2', 'estado' => 1 ],
            [ 'codigo' => 13, 'descripcion' => 'L3', 'estado' => 1 ],
            [ 'codigo' => 14, 'descripcion' => 'L4', 'estado' => 1 ],
            [ 'codigo' => 15, 'descripcion' => 'L5', 'estado' => 1 ],
        ]);
    }
}
