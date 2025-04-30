<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AseguradoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polizas = [
            [
                'id' => 1,
                'descripcion' => 'INTERSEGURO',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 2,
                'descripcion' => 'RIMAC SEGUROS',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 3,
                'descripcion' => 'LA POSITIVA',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 4,
                'descripcion' => 'MAPFRE PERU',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 5,
                'descripcion' => 'PACIFICO SEGUROS',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 6,
                'descripcion' => 'HDI SEGUROS S.A.',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 7,
                'descripcion' => 'SEGUROS SURA',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 8,
                'descripcion' => 'PROTECTA',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 9,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO CHIMBOTE "AFOCAT CHIMBOTE REGION ANCASH"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 10,
                'descripcion' => 'ASOCIACION FONDO REGIONAL CONTRA ACCIDENTES DE TRANSITO DE ANCASH "AFOCAT - ANCASH"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 11,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRÁNSITO LA ÚNICA "AFOCAT LA ÚNICA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 12,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION AREQUIPA "AFOCAT - REGION AREQUIPA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 0           // No Habilitado
            ],
            [
                'id' => 13,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DEL FRENTE UNICO DE TRANSPORTE PUBLICO URBANO E INTERURBANO DE LA REGION AREQUIPA "AFOCAT FUTUIRA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 14,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION AREQUIPA Y ANEXOS "AFOCAT RAVISUR"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 15,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION DE CAJAMARCA "AFOCAT - REGION CAJAMARCA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 16,
                'descripcion' => 'ASOCIACION FONDO DE COBERTURAS DE ACCIDENTES DE TRANSITO DEL CUMBE "AFOCATCDC"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 17,
                'descripcion' => 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO REGION CUSCO "AFOCAT REGION CUSCO"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 18,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO LA SOLUCION DEL CUSCO "AFOCAT LA SOLUCIÓN CUSCO"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 19,
                'descripcion' => 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRÁNSITO REGIONAL BELLA DURMIENTE "AFOCAT REGIONAL BELLA DURMIENTE"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 20,
                'descripcion' => 'ASOCIACIÓN FONDO CONTRA ACCIDENTES DE TRÁNSITO REGIONAL LEON DE HUÁNUCO "AFOCAT LEÓN DE HUÁNUCO"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 21,
                'descripcion' => 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO REGION ICA "AFOCAT REGION ICA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 22,
                'descripcion' => 'ASOCIACIÓN DE FONDOS CONTRA ACCIDENTES DE TRÁNSITO EL ÁNGEL "AFOCAT EL ÁNGEL"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 23,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION JUNIN "AFOCAT - JUNIN"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 24,
                'descripcion' => 'ASOCIACIÓN DE FONDO CONTRA ACCIDENTES DE TRANSITO UNION "AFOCAT"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 25,
                'descripcion' => 'ASOCIACIÓN DE FONDO CONTRA ACCIDENTES DE TRANSITO DE LOS TRANSPORTISTAS DE LA REGION JUNIN PASCO HUANUCO "AFOCAT R.J.P.H."',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 26,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO MACRO REGION NOR-ORIENTE "AFOCAT - CENTRO NOR - ORIENTE"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 27,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION LA LIBERTAD "AFOCAT - TRUJILLO REGION LA LIBERTAD"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 28,
                'descripcion' => 'ASOCIACION FONDO DE COBERTURA DE ACCIDENTES DE TRANSITO - LA LIBERTAD "AFOCAT LA LIBERTAD"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 29,
                'descripcion' => 'ASOCIACION FONDO REGIONAL CONTRA ACCIDENTES DE TRANSITO NUEVO HORIZONTE REGION LA LIBERTAD "AFOCAT NUEVO HORIZONTE REGION LA LIBERTAD"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 30,
                'descripcion' => 'ASOCIACION DE USUARIOS DEL FONDO REGIONAL CONTRA ACCIDENTES DE TRANSITO - FORCAT "FORCAT"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 31,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO LIDER PERU "AFOCAT LÍDER PERÚ"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 32,
                'descripcion' => 'AUTOSEGUROS DE FONDOS CONTRA ACCIDENTES DE TRANSITO DE LIMA "AUTOSEGUROS AFOCAT LIMA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 33,
                'descripcion' => 'AUTOSEGURO ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO ""AUTOSEGURO AFOCAT""',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 34,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO LIMA METROPOLITANA "AFOCAT LIMA METROPOLITANA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 35,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION LIMA METROPOLITANA Y PROVINCIA CONSTITUCIONAL DEL CALLAO "AFOCAT - REGION LIMA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 36,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO PREMIUM "AFOCAT PREMIUM"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 37,
                'descripcion' => 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO SOCAT PERU "AFOCAT SOCAT PERÚ"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 0           // No Habilitado
            ],
            [
                'id' => 38,
                'descripcion' => 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO (AFOCAT) NUESTRA SEÑORA DE LA ASUNCIÓN "NUESTRA SEÑORA DE LA ASUNCIÓN"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 39,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION LIMA PROVINCIAS "AFOCAT LIMA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 0           // No Habilitado
            ],
            [
                'id' => 40,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO ORIENTE - REGION LORETO "AFOCAT DEL ORIENTE - REGION LORETO"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 41,
                'descripcion' => 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO DE LA REGION MOQUEGUA "AFOCAT MOQUEGUA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 42,
                'descripcion' => 'ASOCIACION DEL FONDO CONTRA ACCIDENTES DE TRANSITO - AFOCAT TRANS REGION PIURA "AFOCAT TRANS REGION PIURA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 43,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO - PIURA "AFOCAT - PIURA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 44,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO LA PRIMERA "AFOCAT LA PRIMERA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 45,
                'descripcion' => 'FONDO CONTRA ACCIDENTES DE TRANSITO REGIÓN PUNO "FONCAT"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 0           // No Habilitado
            ],
            [
                'id' => 46,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE PUNO "AFOCAT PUNO"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 0           // No Habilitado
            ],
            [
                'id' => 47,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO DE LA REGION SAN MARTIN "AFOCAT REGION SAN MARTIN"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 48,
                'descripcion' => 'ASOCIACIÓN DE FONDOS CONTRA ACCIDENTES DE TRÁNSITO AFOCAT - AFOSECAT - SAN MARTIN "AFOCAT - AFOSECAT - SAN MARTÍN"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 49,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO SUR PERÚ REGION TACNA "AFOCAT SUR PERÚ REGIÓN TACNA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 50,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO REGION TACNA "AFOCAT REGION TACNA"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 51,
                'descripcion' => 'FONDO DE ASISTENCIA SOCIAL DE LOS MOTOTAXISTAS Y TRANSPORTISTAS DE TUMBES "FASMOT"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 52,
                'descripcion' => 'ASOCIACION FONDO CONTRA ACCIDENTES DE TRANSITO REGIONAL UCAYALINO "AFOCAT UCAYALINO REGIÓN UCAYALI"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 53,
                'descripcion' => 'BNP PARIBAS CARDIF',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 54,
                'descripcion' => 'CRECER SEGUROS S. A.',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 55,
                'descripcion' => 'INSUR',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 56,
                'descripcion' => 'CHUBB PERU',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 57,
                'descripcion' => 'RIMAC SEGUROS',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 58,
                'descripcion' => 'VIVIR SEGUROS',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 59,
                'descripcion' => 'OHIO NACIONAL VIDA',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 60,
                'descripcion' => 'COFACE',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 61,
                'descripcion' => 'AVLA PERU',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 62,
                'descripcion' => 'LIBERTY SEGUROS',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 63,
                'descripcion' => 'SECREX',
                'tipo_poliza_id' => 1,  // SOAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 64,
                'descripcion' => 'ASOCIACION DE FONDOS CONTRA ACCIDENTES DE TRANSITO REGION CENTRO "AFOCAT REGION CENTRO"',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 65,
                'descripcion' => 'AFOCAT EL ALTIPLANO',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ],
            [
                'id' => 66,
                'descripcion' => 'AFOCAT CONFIANZA (ANTES AUTOSEGUROS DE FONDOS CONTRA ACCIDENTES DETRANSITO DE LIMA)',
                'tipo_poliza_id' => 2,  // AFOCAT
                'estado' => 1           // Habilitado
            ]
        ];
        
        DB::table('aseguradora')->delete();
        DB::table('aseguradora')->insert($polizas);
    }
}
