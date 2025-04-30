<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_servicio')->delete();
        DB::table('tipo_servicio')->insert([
            ['codigo' => 0, 'descripcion' => 'Ninguno', 'estado'=>1],
            ['codigo' => 1, 'descripcion' => 'Transporte Regular de Personas', 'estado'=>1],
            ['codigo' => 2, 'descripcion' => 'Transporte Privado de Personas', 'estado'=>1],
            ['codigo' => 3, 'descripcion' => 'Transporte Especial de Personas - Turístico', 'estado'=>1],
            ['codigo' => 4, 'descripcion' => 'Transporte Especial de Personas - Trabajadores', 'estado'=>1],
            ['codigo' => 5, 'descripcion' => 'Transporte Especial de Personas - Estudiantes', 'estado'=>1],
            ['codigo' => 6, 'descripcion' => 'Transporte Especial de Personas - Social', 'estado'=>1],
            ['codigo' => 7, 'descripcion' => 'Transporte Especial de Personas - Auto Colectivo', 'estado'=>1],
            ['codigo' => 8, 'descripcion' => 'Transporte Especial de Personas - Taxi', 'estado'=>1],
            ['codigo' => 9, 'descripcion' => 'Transporte de Mercancías en General Público', 'estado'=>1],
            ['codigo' => 10, 'descripcion' => 'Transporte de Mercancías Privado', 'estado'=>1],
            ['codigo' => 11, 'descripcion' => 'Transporte de Materiales y Residuos Peligrosos', 'estado'=>1],
            ['codigo' => 12, 'descripcion' => 'Servicio Especial Comunal de Transporte de Pasajeros por Carretera', 'estado'=>1],
            ['codigo' => 13, 'descripcion' => 'Servicio de Transporte Publico Especial de Pasajeros de Pasajeros en Vehículos Menores.' , 'estado'=>1],
            ['codigo' => 14, 'descripcion' => 'Servicio de Transporte Mixto.' , 'estado'=>1],
            ['codigo' => 15, 'descripcion' => 'Servicio de Transporte Internacional de Pasajeros por Carretera de la Comunidad Andina.' , 'estado'=>1],
            ['codigo' => 16, 'descripcion' => 'Servicio de Transporte Internacional de Mercancías por Carretera de la Comunidad Andina.' , 'estado'=>1],
            ['codigo' => 17, 'descripcion' => 'Servicio de Transporte de Pasajeros por Carretera entre Tacna – Arica.' , 'estado'=>1],
            ['codigo' => 18, 'descripcion' => 'Servicio de Transporte Transfronterizo de Pasajeros en Ómnibus Entre Perú – Ecuador.' , 'estado'=>1],
            ['codigo' => 19, 'descripcion' => 'Servicio de Transporte Transfronterizo de Pasajeros en Taxi Entre Perú – Ecuador.' , 'estado'=>1],
            ['codigo' => 20, 'descripcion' => 'Servicio de Transporte Transfronterizo Turístico entre Perú – Ecuador.' , 'estado'=>1],
            ['codigo' => 21, 'descripcion' => 'Servicio de Transporte Transfronterizo de Mercancías entre Perú – Ecuador.' , 'estado'=>1],
            ['codigo' => 22, 'descripcion' => 'Servicio de Transporte Internacional Terrestre de Pasajeros por Carretera - ATIT (Cono Sur).' , 'estado'=>1],
            ['codigo' => 23, 'descripcion' => 'Servicio de Transporte Internacional Terrestre de Mercancías por Carretera - ATIT (Cono Sur).' , 'estado'=>1],
        ]);
    }
}
