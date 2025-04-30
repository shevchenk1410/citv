<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuario')->delete();
        DB::table('usuario')->insert([
            'id' => 1,
            'nombres' => 'admin',
            'apellidos' => 'admin',
            'sucursal_id' => 0,
            'password' => bcrypt('admin'),
            'estado' => 1,
            'dni' => '00000000',
        ]);
    }
}
