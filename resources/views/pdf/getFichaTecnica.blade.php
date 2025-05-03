<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Certificado de Inspección Técnica Vehicular</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 10px;
            font-size: 10px;
            box-sizing: border-box;
        }

        *,
        *::before,
        *::after {
            box-sizing: inherit;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .subheader {
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 3px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .section-header {
            background-color: #f2f2f2;
            font-weight: bold;
            padding: 5px;
            border: 1px solid #000;
            margin-bottom: 5px
        }

        /* Reemplazamos el sistema de flexbox con tablas para DomPDF */
        .multi-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 5px 0;
        }

        .multi-table td {
            padding: 0;
            border: none;
            vertical-align: top;
        }

        .small-text {
            font-size: 10px;
        }

        .result-a {
            font-weight: bold;
            text-align: center;
        }

        .center-text {
            text-align: center;
        }

        .multi-table table,
        .multi-table table td,
        .multi-table table th {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .multi-table table td,
        .multi-table table th {
            padding: 3px;
            /* más espacio interno */
        }

        /* SECCION 5 */
        .small-header {
            font-size: 10px;
            font-weight: bold;
        }

        .firma-cell {
            vertical-align: bottom;
            text-align: center;
            position: relative;
        }

        .firma-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 0 auto 3px auto;
        }

        .firma-text {
            padding: 10px;
            font-size: 10px;
        }

        .small-text {
            font-size: 9px;
            margin: 0 0 3px 0;
        }

        .tabla-centro {
            font-size: 9px;
            text-align: center;
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-centro td {
            padding: 2px;
            vertical-align: middle;
        }
    </style>

</head>

<body>
    <div class="header">CERTIFICADO DE INSPECCIÓN TÉCNICA VEHICULAR</div>
    <div class="subheader">Nº: {{ $datos['certificado']['numero'] ?? 'C-2025-314-456-001917' }}</div>

    <table class="small-text">
        <tr>
            <td><strong>Tipo de Inspección:</strong></td>
            <td>Inspección Técnica Ordinaria + Complementaria</td>
            <td><strong>Fecha de Inspección:</strong></td>
            <td>{{ $datos['created_at'] ? $datos['created_at']->format('d/m/Y') : '' }}</td>
            <td><strong>Informe de Inspección:</strong></td>
            <td>{{ $datos['certificado']['informe'] ?? '7335 - 6772' }}</td>
        </tr>
    </table>

    <div class="section-header">I. CARACTERÍSTICAS DEL VEHÍCULO</div>
    <table>
        <tr>
            <td width="3%">1.</td>
            <td width="15%">Placa</td>
            <td width="15%">{{ $datos['PLACA'] ?? '' }}</td>
            <td width="3%">7.</td>
            <td width="15%">Combustible</td>
            <td width="15%">{{ $datos['COMBUSTIBLE'] ?? '' }}</td>
            <td width="3%">13.</td>
            <td width="15%">Asientos / Pasajeros</td>
            <td width="15%">{{ $datos['NUMEROASIENTOS'] ?? '' }} / {{ $datos['NUMEROPASAJEROS'] ?? '' }}</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Categoría</td>
            <td>{{ $datos['CATEGORIA'] ?? '' }}</td>
            <td>8.</td>
            <td>VIN / Nº de Serie</td>
            <td>{{ $datos['VINSERCHA'] ?? '' }}</td>
            <td>14.</td>
            <td>Largo / Ancho / Alto</td>
            <td>{{ $datos['LARGO'] ?? '' }} / {{ $datos['ANCHO'] ?? '' }} / {{ $datos['ALTO'] ?? '' }}</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Marca</td>
            <td>{{ $datos['MARCA'] ?? '' }}</td>
            <td>9.</td>
            <td>Nº de Motor</td>
            <td>{{ $datos['NUMEROMOTOR'] ?? '' }}</td>
            <td>15.</td>
            <td>Color (es)</td>
            <td>{{ $datos['COLOR'] ?? '' }}</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Modelo</td>
            <td>{{ $datos['MODELO'] ?? '' }}</td>
            <td>10.</td>
            <td>Carrocería</td>
            <td>{{ $datos['CARROCERIA'] ?? '' }}</td>
            <td>16.</td>
            <td>Peso Neto (kg)</td>
            <td>{{ $datos['PESONETO'] ?? '' }}</td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Año de Fabricación</td>
            <td>{{ $datos['ANOFAB'] ?? '' }}</td>
            <td>11.</td>
            <td>Marca de Carrocería</td>
            <td>{{ $datos['CARROCERIA'] ?? '' }}</td>
            <td>17.</td>
            <td>Peso Bruto (kg)</td>
            <td>{{ $datos['PESOBRUTO'] ?? '' }}</td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Kilometraje</td>
            <td>{{ $datos['kilometraje'] ?? '156,556' }}</td>
            <td>12.</td>
            <td>Nº Ejes / Nº Ruedas</td>
            <td>{{ $datos['NUMEROEJES'] ?? '' }} / {{ $datos['NUMERORUEDAS'] ?? '' }} </td>
            <td>18.</td>
            <td>Peso Útil (kg)</td>
            <td>{{ $datos['PESOUTIL'] ?? '' }}</td>
        </tr>
    </table>

    <div class="section-header">II. DATOS DE LOS EQUIPOS</div>
    <table style="font-size:9px; text-align:center; width:100%; border-collapse:collapse;">
        <tr>
            <td style="text-align:center;" width="5%">CITV</td>
            <td style="text-align:center;" width="10%">CITV S.A.C.</td>
            <td style="text-align:center;" width="15%" colspan="2">Frenómetro</td>
            <td style="text-align:center;" width="15%" colspan="2">Alineador</td>
            <td style="text-align:center;" width="20%" colspan="2">Analizador u Opacímetro</td>
            <td style="text-align:center;" width="15%" colspan="2">Regloscopio Luxómetro</td>
            <td style="text-align:center;" width="20%" colspan="2">Banco de Suspensión</td>
        </tr>
        <tr>
            <td style="text-align:center;"><strong>Linea</strong></td>
            <td style="text-align:center;"><strong>Mixta</strong></td>
            <td style="text-align:center;">Equipo Nº</td>
            <td style="text-align:center;">100007</td>
            <td style="text-align:center;">Equipo Nº</td>
            <td style="text-align:center;">100007-03</td>
            <td style="text-align:center;">Equipo Nº</td>
            <td style="text-align:center;">AGS3010</td>
            <td style="text-align:center;">EquipoNº </td>
            <td style="text-align:center;">XY11</td>
            <td style="text-align:center;">Equipo Nº </td>
            <td style="text-align:center;">10000-257</td>
        </tr>
    </table>


    <div class="section-header">III. RESULTADOS OBTENIDOS</div>
    <table style="font-size:8px">
        <tr>
            <td colspan="19" class="center-text" style="font-weight: bold; text-align: center; vertical-align: middle; "><strong>PRUEBA DE FRENOS</strong></td>
        </tr>
        <tr>
            <td colspan="7" class="center-text" style="font-weight: bold; text-align: center; vertical-align: middle; "><strong>FRENO DE SERVICIO</strong></td>
            <td colspan="6" class="center-text" style="font-weight: bold; text-align: center; vertical-align: middle; "><strong>FRENO DE ESTACIONAMIENTO</strong></td>
            <td colspan="6" class="center-text" style="font-weight: bold; text-align: center; vertical-align: middle; "><strong>FRENO DE EMERGENCIA</strong></td>
        </tr>
        <tr>
            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Ejes</td>
            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Peso<br>(Kg)</td>
            <td colspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Fuerza de<br>Frenado (kN)</td>
            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Deseq.<br>(%)</td>
            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Eficiencia<br>(%)</td>
            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Resultado</td>

            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Ejes</td>
            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Peso<br>(Kg)</td>
            <td colspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Fuerza de<br>Frenado (kN)</td>
            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Eficiencia<br>(%)</td>
            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Resultado</td>

            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Ejes</td>
            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Peso<br>(Kg)</td>
            <td colspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Fuerza de<br>Frenado (kN)</td>
            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Eficiencia<br>(%)</td>
            <td rowspan="2" style="font-weight: bold; text-align: center; vertical-align: middle; ">Resultado</td>
        </tr>
        <tr>
            <td  style="font-weight: bold; text-align: center; vertical-align: middle; ">Der.</td>
            <td style="font-weight: bold; text-align: center; vertical-align: middle; ">Izq.</td>
            <td style="font-weight: bold; text-align: center; vertical-align: middle; ">Der.</td>
            <td style="font-weight: bold; text-align: center; vertical-align: middle; ">Izq.</td>
            <td style="font-weight: bold; text-align: center; vertical-align: middle; ">Der.</td>
            <td style="font-weight: bold; text-align: center; vertical-align: middle; ">Izq.</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">1º</td>
            <td>{{ $datos['evaluacion']['FS_EJE1_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE1_FUERZA_DER'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE1_FUERZA_IZQ'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE1_DESEQUILIBRIO'] ?? '' }}</td>
            <td rowspan="5">{{ $datos['evaluacion']['FS_EFICIENCIA_TOTAL'] ?? '' }}</td>
            <td rowspan="5" class="result-a">{{ $datos['evaluacion']['FS_RESULTADO'] ?? '' }}</td>

            <td style="font-weight: bold;">1º</td>
            <td>{{ $datos['evaluacion']['FE_EJE1_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FE_EJE1_FUERZA_DER'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FE_EJE1_FUERZA_IZQ'] ?? '' }}</td>
            <td rowspan="5">{{ $datos['evaluacion']['FE_EFICIENCIA_TOTAL'] ?? '' }}</td>
            <td rowspan="5" class="result-a">{{ $datos['evaluacion']['FE_RESULTADO'] ?? '' }}</td>

            <td style="font-weight: bold;">1º</td>
            <td>{{ $datos['evaluacion']['FEM_EJE1_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FEM_EJE1_FUERZA'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FEM_EJE1_FUERZA_IZQ'] ?? '' }}</td>
            <td rowspan="5">{{ $datos['evaluacion']['FEM_EFICIENCIA_TOTAL'] ?? '' }}</td>
            <td rowspan="5">{{ $datos['evaluacion']['FEM_RESULTAD'] ?? '' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">2º</td>
            <td>{{ $datos['evaluacion']['FS_EJE2_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE2_FUERZA_DER'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE2_FUERZA_IZQ'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE2_DESEQUILIBRIO'] ?? '' }}</td>

            <td style="font-weight: bold;">2º</td>
            <td>{{ $datos['evaluacion']['FE_EJE2_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FE_EJE2_FUERZA_DER'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FE_EJE2_FUERZA_IZQ'] ?? '' }}</td>

            <td style="font-weight: bold;">2º</td>
            <td>{{ $datos['evaluacion']['FEM_EJE2_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FEM_EJE2_FUERZA'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FEM_EJE2_FUERZA_IZQ'] ?? '' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">3º</td>
            <td>{{ $datos['evaluacion']['FS_EJE3_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE3_FUERZA_DER'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE3_FUERZA_IZQ'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE3_DESEQUILIBRIO'] ?? '' }}</td>

            <td style="font-weight: bold;">3º</td>
            <td>{{ $datos['evaluacion']['FE_EJE3_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FE_EJE3_FUERZA_DER'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FE_EJE3_FUERZA_IZQ'] ?? '' }}</td>

            <td style="font-weight: bold;">3º</td>
            <td>{{ $datos['evaluacion']['FEM_EJE3_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FEM_EJE3_FUERZA'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FEM_EJE3_FUERZA_IZQ'] ?? '' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">4º</td>
            <td>{{ $datos['evaluacion']['FS_EJE4_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE4_FUERZA_DER'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE4_FUERZA_IZQ'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE4_DESEQUILIBRIO'] ?? '' }}</td>

            <td style="font-weight: bold;">4º</td>
            <td>{{ $datos['evaluacion']['FE_EJE4_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FE_EJE4_FUERZA_DER'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FE_EJE4_FUERZA_IZQ'] ?? '' }}</td>

            <td style="font-weight: bold;">4º</td>
            <td>{{ $datos['evaluacion']['FEM_EJE4_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FEM_EJE4_FUERZA'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FEM_EJE4_FUERZA_IZQ'] ?? '' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">5º</td>
            <td>{{ $datos['evaluacion']['FS_EJE5_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE5_FUERZA_DER'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE5_FUERZA_IZQ'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FS_EJE5_DESEQUILIBRIO'] ?? '' }}</td>

            <td style="font-weight: bold;">5º</td>
            <td>{{ $datos['evaluacion']['FE_EJE5_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FE_EJE5_FUERZA_DER'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FE_EJE5_FUERZA_IZQ'] ?? '' }}</td>

            <td style="font-weight: bold;">5º</td>
            <td>{{ $datos['evaluacion']['FEM_EJE5_PESO'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FEM_EJE5_FUERZA'] ?? '' }}</td>
            <td>{{ $datos['evaluacion']['FEM_EJE5_FUERZA_IZQ'] ?? '' }}</td>
        </tr>
    </table>

    <!-- Reemplazamos los divs con clase multi-table por tablas estructuradas para DomPDF -->
    <table class="multi-table" style="font-size:8px">
        <tr>
            <td width="18%" style="margin-right: 0">
                <table >
                    <tr>
                        <td colspan="3" class="center-text"><strong>PRUEBA DE ALINEAMIENTO</strong></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; height: 30px; text-align: center; vertical-align: middle;">Ejes
                        </td>
                        <td style="font-weight: bold; height: 30px; text-align: center; vertical-align: middle;">
                            Desviación<br>(m/km)</td>
                        <td style="font-weight: bold; height: 30px; text-align: center; vertical-align: middle;">
                            Resultado</td>
                    </tr>
                    <tr>
                        <td  style="font-weight: bold;  text-align: center; vertical-align: middle;">1º</td>
                        <td style="  text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['AL_EJE1_DESVIACION'] ?? '' }}</td>
                        <td style=" text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['AL_EJE1_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;  text-align: center; vertical-align: middle;">2º</td>
                        <td style=" text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['AL_EJE2_DESVIACION'] ?? '' }}</td>
                        <td style=" text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['AL_EJE2_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;  text-align: center; vertical-align: middle;">3º</td>
                        <td style=" text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['AL_EJE3_DESVIACION'] ?? '' }}</td>
                        <td style=" text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['AL_EJE3_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;  text-align: center; vertical-align: middle;">4º</td>
                        <td style=" text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['AL_EJE4_DESVIACION'] ?? '' }}</td>
                        <td style="  text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['AL_EJE4_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;  text-align: center; vertical-align: middle;">5º</td>
                        <td style="  text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['AL_EJE5_DESVIACION'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['AL_EJE5_RESULTADO'] ?? '' }}</td>
                    </tr>
                </table>
            </td>
            <td width="16%" style="margin-left: 0">
                <table>
                    <tr>
                        <td colspan="3" class="center-text"><strong>PROF. DE NEUMÁTICOS</strong></td>
                    </tr>
                    <tr>
                        <td style="height: 30px; text-align: center; vertical-align: middle; font-weight: bold;">Ejes
                        </td>
                        <td style="height: 30px; text-align: center; vertical-align: middle; font-weight: bold;">
                            Medida Obtenida<br>(mm)</td>
                        <td style="height: 30px; text-align: center; vertical-align: middle; font-weight: bold;">
                            Resultado</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;  text-align: center; vertical-align: middle;">1º</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['NEU_EJE1_MEDIDA_DER'] ?? '' }} / {{ $datos['evaluacion'][' NEU_EJE1_MEDIDA_IZQ'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;" class="result-a">{{ $datos['evaluacion']['NEU_EJE1_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;  text-align: center; vertical-align: middle;">2º</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['NEU_EJE2_MEDIDA_DER'] ?? '' }} / {{ $datos['evaluacion'][' NEU_EJE2_MEDIDA_IZQ'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;" class="result-a">{{ $datos['evaluacion']['NEU_EJE2_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;  text-align: center; vertical-align: middle;">3º</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['NEU_EJE3_MEDIDA_DER'] ?? '' }} / {{ $datos['evaluacion'][' NEU_EJE3_MEDIDA_IZQ'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;" class="result-a">{{ $datos['evaluacion']['NEU_EJE3_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;  text-align: center; vertical-align: middle;">4º</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['NEU_EJE4_MEDIDA_DER'] ?? '' }} / {{ $datos['evaluacion'][' NEU_EJE4_MEDIDA_IZQ'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;" class="result-a">{{ $datos['evaluacion']['NEU_EJE4_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;  text-align: center; vertical-align: middle;">5º</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['NEU_EJE5_MEDIDA_DER'] ?? '' }} / {{ $datos['evaluacion'][' NEU_EJE5_MEDIDA_IZQ'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;" class="result-a">{{ $datos['evaluacion']['NEU_EJE5_RESULTADO'] ?? '' }}</td>
                    </tr>
                </table>
            </td>
            <td width="40%">
                <table>
                    <tr>
                        <td colspan="5" class="center-text"><strong>PRUEBA DE LUCES</strong></td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="font-size: 8px; font-weight: bold; width: 30%;">Tipo de Luz</td>
                        <td colspan="2" style="font-size: 6px; font-weight: bold; text-align: center; width: 40%;">
                            Medida Obtenida<br>(Lux o c)</td>
                        <td rowspan="2" style="font-size: 8px; font-weight: bold; width: 10%;">Alineamiento</td>
                        <td rowspan="2" style="font-size: 8px; font-weight: bold; width: 10%;">Resultado</td>
                    </tr>
                    <tr>
                        <td style="font-size: 7px; font-weight: bold;">Der</td>
                        <td style="font-size: 7px; font-weight: bold;">Izq</td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; font-weight: bold;">Bajas</td>
                        <td  style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_BAJA_DER'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_BAJA_IZQ'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_BAJA_ALINEAMIENTO'] ?? '' }}</td>
                        <td  class="result-a">{{ $datos['evaluacion']['LUZ_BAJA_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; font-weight: bold;">Altas</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_ALTA_DER'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_ALTA_IZQ'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_ALTA_ALINEAMIENTO'] ?? '' }}</td>
                        <td class="result-a">{{ $datos['evaluacion']['LUZ_ALTA_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; font-weight: bold;">Altas Adicional</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_ADICIONAL_DER'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_ADICIONAL_IZQ'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_ADICIONAL_ALINEAMIENTO'] ?? '' }}</td>
                        <td class="result-a">{{ $datos['evaluacion']['LUZ_ADICIONAL_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 8px; font-weight: bold;">Neblineros</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_NEBLINEROS_DER'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_NEBLINEROS_IZQ'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['LUZ_NEBLINEROS_ALINEAMIENTO'] ?? '' }}</td>
                        <td class="result-a">{{ $datos['evaluacion']['LUZ_NEBLINEROS_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" style="font-size: 6px; font-style: italic; height: 11px;">
                            (1) Valores de referencia del haz de luz: la luz alta CD / CSD / AD / ASD
                        </td>

                    </tr>
                </table>
            </td>

            <td width="30%">
                <table>
                    <tr>
                        <td colspan="4" class="center-text"><strong>PRUEBA DE SUSPENSIÓN</strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 30px; text-align: center; vertical-align: middle; font-weight: bold;">
                            Delantera<br>(%)</td>
                        <td colspan="2" style="height: 30px; text-align: center; vertical-align: middle; font-weight: bold;">
                            Posterior<br>(%)</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; ">Izq.</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['SUSP_DELANTERA_IZQ'] ?? '' }}</td>
                        <td style="text-align: center; vertical-align: middle;" style="font-weight: bold; ">Izq.</td>
                        <td>{{ $datos['evaluacion']['SUSP_POSTERIOR_IZQ'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; ">Der.</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['SUSP_DELANTERA_DER'] ?? '' }}</td>
                        <td style="font-weight: bold; ">Der.</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['SUSP_POSTERIOR_DER'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; ">Desv.</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['SUSP_DELANTERA_DESV'] ?? '' }}</td>
                        <td style="font-weight: bold; ">Desv.</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['SUSP_POSTERIOR_DESV'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; ">Resultado</td>
                        <td class="result-a">{{ $datos['evaluacion']['SUSP_DELANTERA_RESULTADO'] ?? '' }}</td>
                        <td style="font-weight: bold; ">Resultado</td>
                        <td class="result-a">{{ $datos['evaluacion']['SUSP_POSTERIOR_RESULTADO'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="result-a center-text"><strong>Resultado Final</strong></td>
                        <td colspan="1" class="result-a center-text"><strong>{{ $datos['evaluacion']['SUSP_RESULTADO_FINAL'] ?? '' }}</strong></td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

    <table class="multi-table" width="100%"  style="font-size:8px">
        <tr>
            <td width="75%">
                <table border="1" width="100%" cellspacing="0" cellpadding="4">
                    <tr style="text-align: center;">
                      <td rowspan="3" style="font-weight: bold; text-align: center; vertical-align: middle; width: 15%;">
                        EMISIONES DE GASES<br>
                        <span style="font-weight: normal;">(No aplica para vehículos eléctricos)</span>
                      </td>
                      <td style="width: 25%;"><strong>Temp. Aceite (°C)</strong></td>
                      <td style="width: 20%; text-align: right;">{{ $datos['evaluacion']['EMIS_TEMP_ACEITE'] ?? '' }} / {{ $datos['evaluacion']['EMIS_TEMP_ACEITE_DER'] ?? '' }}</td>
                      <td style="width: 31%;"><strong>CO Ralentí (%)</strong></td>
                      <td style="width: 12%; text-align: right;">{{ $datos['evaluacion']['EMIS_CO_RALENTI'] ?? '' }}</td>
                      <td style="width: 32%;"><strong>CO Aceleración (%)</strong></td>
                      <td style="width: 12%; text-align: right;">{{ $datos['evaluacion']['EMIS_CO_ACELERACION'] ?? '' }}</td>
                      <td style="width: 18%; font-weight: bold; text-align: center;"><strong>Resultado</strong></td>
                    </tr>
                    <tr style="text-align: center;">
                      <td><strong>RPM</strong></td>
                      <td style="text-align: right;">{{ $datos['evaluacion']['EMIS_RPM'] ?? '' }} / {{ $datos['evaluacion']['EMIS_RPM_DER'] ?? '' }}</td>
                      <td><strong>CO + CO2 Ralentí (%)</strong></td>
                      <td style="text-align: right;">{{ $datos['evaluacion']['EMIS_CO2_RALENTI'] ?? '' }}</td>
                      <td><strong>CO + CO2 Acel. (%)</strong></td>
                      <td style="text-align: right;">{{ $datos['evaluacion']['EMIS_CO2_ACELERACION'] ?? '' }}</td>
                      <td rowspan="2" style="text-align: center; vertical-align: middle;">
                        <strong>{{ $datos['evaluacion']['EMIS_RESULTADO'] ?? '' }}</strong>
                      </td>
                    </tr>
                    <tr style="text-align: center;">
                      <td><strong>Opacidad (m⁻¹)</strong></td>
                      <td style="text-align: right;">{{ $datos['evaluacion']['EMIS_OPACIDAD'] ?? '' }} / {{ $datos['evaluacion']['EMIS_OPACIDAD_DER'] ?? '' }}</td>
                      <td><strong>HC Ralentí (ppm)</strong></td>
                      <td style="text-align: right;">{{ $datos['evaluacion']['EMIS_HC_RALENTI'] ?? '' }}</td>
                      <td><strong>HC Aceleración (ppm)</strong></td>
                      <td style="text-align: right;">{{ $datos['evaluacion']['EMIS_HC_ACELERACION'] ?? '' }}</td>
                    </tr>
                  </table>



            </td>
            <td width="28%">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="text-align: center; height: 67px;">
                        <td rowspan="2" style="font-weight: bold; vertical-align: middle; height: 40px;">EMISIONES<br>SONORAS</td>
                        <td style="height: 8px;font-weight: bold; ">Sonómetro (dB)</td>
                        <td style="height: 8px;font-weight: bold; ">Resultado</td>
                    </tr>
                    <tr style="text-align: center; height: 46px;">
                        <td style="height: 46px;text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['EMIS_SONORA_DB'] ?? '' }}</td>
                        <td class="result-a" style="height: 46px;font-weight: bold;text-align: center; vertical-align: middle;">{{ $datos['evaluacion']['EMIS_SONORA_RESULTADO'] ?? '' }}</td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>


    <div class="section-header"> IV. DEFECTOS ENCONTRADOS</div>
    <table>
        <tr>
            <td width="20%"><strong>CÓDIGO</strong></td>
            <td width="60%"><strong>INTERPRETACIÓN DE DEFECTOS</strong></td>
            <td width="20%"><strong>CLASIFICACIÓN</strong></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </table>
    <div><strong>Nota:</strong> Las observaciones efectuadas deben ser subsanadas antes de la siguiente Inspección
        Técnica Vehicular</div>
        <br>

    <div class="section-header">V. RESULTADO DE LA INSPECCIÓN TÉCNICA VEHICULAR</div>
    <table>
        <tr>
            <td width="20%"><span class="small-header">Resultado de la Inspección</span></td>
            <td width="20%"><span class="small-header">Vigencia del Certificado</span></td>
            <td width="20%"><span class="small-header">Fecha de la Próxima Inspección</span></td>
            <td width="40%" rowspan="2" class="firma-cell">
                <div class="firma-line"></div>
                <div class="firma-text">Firma del Ingeniero Supervisor</div>
            </td>
        </tr>
        @php
            $estados = [
                0 => 'CANCELADO',
                1 => 'PENDIENTE',
                2 => 'DESAPROBADO',
                3 => 'APROBADO',
            ];

            $estado = $datos['estado'];
            $estadoTexto = $estados[$estado] ?? 'SIN ESTADO';
            $fechaFinal = \Carbon\Carbon::parse($datos['updated_at'])->addYear()->format('d / m / Y');

            // Mostrar datos solo si es estado 3
            $mostrarDuracion = $estado == 3 ? '12 MESES' : '';
            $mostrarFechaFinal = $estado == 3 ? $fechaFinal : '';
        @endphp

        <tr>
            <td><strong>{{ strtoupper($estadoTexto) }}</strong></td>
            <td><strong>{{ $mostrarDuracion }}</strong></td>
            <td><strong>{{ $mostrarFechaFinal }}</strong></td>
        </tr>
    </table>
</body>

</html>
