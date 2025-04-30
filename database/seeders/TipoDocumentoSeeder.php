<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = [
            ['id'=>1,'nombre'=>'DNI'],
            ['id'=>4,'nombre'=>'C.E.'],
            ['id'=>6,'nombre'=>'RUC'],
            ['id'=>7,'nombre'=>'Pasaporte'],
        ];

        DB::table('tipo_documento')->delete();
        DB::table('tipo_documento')->insert($rows);
    }
}
