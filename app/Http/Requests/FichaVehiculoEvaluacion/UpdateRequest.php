<?php

namespace App\Http\Requests\FichaVehiculoEvaluacion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Control de permisos
    }

    public function rules(): array
    {
        return [
            'ficha_vehiculo_id' => 'required|integer',  // Solo este campo es obligatorio

            // DATOS GENERALES
            'FECHA_REVISION' => 'nullable|date',
            'NUMERO_REVISION' => 'nullable|string|max:20',

            // PRUEBA DE FRENOS - FRENO DE SERVICIO
            'FS_EJE1_PESO' => 'nullable|numeric',
            'FS_EJE1_FUERZA_DER' => 'nullable|numeric',
            'FS_EJE1_FUERZA_IZQ' => 'nullable|numeric',
            'FS_EJE1_DESEQUILIBRIO' => 'nullable|numeric',

            'FS_EJE2_PESO' => 'nullable|numeric',
            'FS_EJE2_FUERZA_DER' => 'nullable|numeric',
            'FS_EJE2_FUERZA_IZQ' => 'nullable|numeric',
            'FS_EJE2_DESEQUILIBRIO' => 'nullable|numeric',

            'FS_EJE3_PESO' => 'nullable|numeric',
            'FS_EJE3_FUERZA_DER' => 'nullable|numeric',
            'FS_EJE3_FUERZA_IZQ' => 'nullable|numeric',
            'FS_EJE3_DESEQUILIBRIO' => 'nullable|numeric',

            'FS_EJE4_PESO' => 'nullable|numeric',
            'FS_EJE4_FUERZA_DER' => 'nullable|numeric',
            'FS_EJE4_FUERZA_IZQ' => 'nullable|numeric',
            'FS_EJE4_DESEQUILIBRIO' => 'nullable|numeric',

            'FS_EJE5_PESO' => 'nullable|numeric',
            'FS_EJE5_FUERZA_DER' => 'nullable|numeric',
            'FS_EJE5_FUERZA_IZQ' => 'nullable|numeric',
            'FS_EJE5_DESEQUILIBRIO' => 'nullable|numeric',

            'FS_EFICIENCIA_TOTAL' => 'nullable|numeric',
            'FS_RESULTADO' => 'nullable|string|size:1',

            // PRUEBA DE FRENOS - FRENO DE ESTACIONAMIENTO
            'FE_EJE1_PESO' => 'nullable|numeric',
            'FE_EJE1_FUERZA_DER' => 'nullable|numeric',
            'FE_EJE1_FUERZA_IZQ' => 'nullable|numeric',

            'FE_EJE2_PESO' => 'nullable|numeric',
            'FE_EJE2_FUERZA_DER' => 'nullable|numeric',
            'FE_EJE2_FUERZA_IZQ' => 'nullable|numeric',

            'FE_EJE3_PESO' => 'nullable|numeric',
            'FE_EJE3_FUERZA_DER' => 'nullable|numeric',
            'FE_EJE3_FUERZA_IZQ' => 'nullable|numeric',

            'FE_EJE4_PESO' => 'nullable|numeric',
            'FE_EJE4_FUERZA_DER' => 'nullable|numeric',
            'FE_EJE4_FUERZA_IZQ' => 'nullable|numeric',

            'FE_EJE5_PESO' => 'nullable|numeric',
            'FE_EJE5_FUERZA_DER' => 'nullable|numeric',
            'FE_EJE5_FUERZA_IZQ' => 'nullable|numeric',

            'FE_EFICIENCIA_TOTAL' => 'nullable|numeric',
            'FE_RESULTADO' => 'nullable|string|size:1',

            // PRUEBA DE FRENOS - FRENO DE EMERGENCIA
            'FEM_EJE1_PESO' => 'nullable|numeric',
            'FEM_EJE1_FUERZA_DER' => 'nullable|numeric',
            'FEM_EJE1_FUERZA_IZQ' => 'nullable|numeric',
            'FEM_EJE1_EFICIENCIA' => 'nullable|numeric',

            'FEM_EJE2_PESO' => 'nullable|numeric',
            'FEM_EJE2_FUERZA_DER' => 'nullable|numeric',
            'FEM_EJE2_FUERZA_IZQ' => 'nullable|numeric',

            'FEM_EJE3_PESO' => 'nullable|numeric',
            'FEM_EJE3_FUERZA_DER' => 'nullable|numeric',
            'FEM_EJE3_FUERZA_IZQ' => 'nullable|numeric',

            'FEM_EJE4_PESO' => 'nullable|numeric',
            'FEM_EJE4_FUERZA_DER' => 'nullable|numeric',
            'FEM_EJE4_FUERZA_IZQ' => 'nullable|numeric',

            'FEM_EJE5_PESO' => 'nullable|numeric',
            'FEM_EJE5_FUERZA_DER' => 'nullable|numeric',
            'FEM_EJE5_FUERZA_IZQ' => 'nullable|numeric',

            'FEM_EFICIENCIA_TOTAL' => 'nullable|numeric',
            'FEM_RESULTADO' => 'nullable|string|size:1',

            // PRUEBA DE ALINEAMIENTO
            'AL_EJE1_DESVIACION' => 'nullable|numeric',
            'AL_EJE1_RESULTADO' => 'nullable|string|size:1',

            'AL_EJE2_DESVIACION' => 'nullable|numeric',
            'AL_EJE2_RESULTADO' => 'nullable|string|size:1',

            'AL_EJE3_DESVIACION' => 'nullable|numeric',
            'AL_EJE3_RESULTADO' => 'nullable|string|size:1',

            'AL_EJE4_DESVIACION' => 'nullable|numeric',
            'AL_EJE4_RESULTADO' => 'nullable|string|size:1',

            'AL_EJE5_DESVIACION' => 'nullable|numeric',
            'AL_EJE5_RESULTADO' => 'nullable|string|size:1',

            // PROFUNDIDAD DE NEUMÁTICOS
            'NEU_EJE1_MEDIDA_DER' => 'nullable|numeric',
            'NEU_EJE1_MEDIDA_IZQ' => 'nullable|numeric',
            'NEU_EJE1_RESULTADO' => 'nullable|string|size:1',

            'NEU_EJE2_MEDIDA_DER' => 'nullable|numeric',
            'NEU_EJE2_MEDIDA_IZQ' => 'nullable|numeric',
            'NEU_EJE2_RESULTADO' => 'nullable|string|size:1',

            'NEU_EJE3_MEDIDA_DER' => 'nullable|numeric',
            'NEU_EJE3_MEDIDA_IZQ' => 'nullable|numeric',
            'NEU_EJE3_RESULTADO' => 'nullable|string|size:1',

            'NEU_EJE4_MEDIDA_DER' => 'nullable|numeric',
            'NEU_EJE4_MEDIDA_IZQ' => 'nullable|numeric',
            'NEU_EJE4_RESULTADO' => 'nullable|string|size:1',

            'NEU_EJE5_MEDIDA_DER' => 'nullable|numeric',
            'NEU_EJE5_MEDIDA_IZQ' => 'nullable|numeric',
            'NEU_EJE5_RESULTADO' => 'nullable|string|size:1',

            // PRUEBA DE LUCES
            'LUZ_BAJA_DER' => 'nullable|numeric',
            'LUZ_BAJA_IZQ' => 'nullable|numeric',
            'LUZ_BAJA_ALINEAMIENTO' => 'nullable|string|max:20',
            'LUZ_BAJA_RESULTADO' => 'nullable|string|size:1',

            'LUZ_ALTA_DER' => 'nullable|numeric',
            'LUZ_ALTA_IZQ' => 'nullable|numeric',
            'LUZ_ALTA_ALINEAMIENTO' => 'nullable|string|max:20',
            'LUZ_ALTA_RESULTADO' => 'nullable|string|size:1',

            'LUZ_ADICIONAL_DER' => 'nullable|numeric',
            'LUZ_ADICIONAL_IZQ' => 'nullable|numeric',
            'LUZ_ADICIONAL_ALINEAMIENTO' => 'nullable|string|max:20',
            'LUZ_ADICIONAL_RESULTADO' => 'nullable|string|size:1',

            'LUZ_NEBLINEROS_DER' => 'nullable|numeric',
            'LUZ_NEBLINEROS_IZQ' => 'nullable|numeric',
            'LUZ_NEBLINEROS_ALINEAMIENTO' => 'nullable|string|max:20',
            'LUZ_NEBLINEROS_RESULTADO' => 'nullable|string|size:1',

            // PRUEBA DE SUSPENSIÓN
            'SUSP_DELANTERA_IZQ' => 'nullable|numeric',
            'SUSP_DELANTERA_DER' => 'nullable|numeric',
            'SUSP_DELANTERA_DESV' => 'nullable|numeric',
            'SUSP_DELANTERA_RESULTADO' => 'nullable|string|size:1',

            'SUSP_POSTERIOR_IZQ' => 'nullable|numeric',
            'SUSP_POSTERIOR_DER' => 'nullable|numeric',
            'SUSP_POSTERIOR_DESV' => 'nullable|numeric',
            'SUSP_POSTERIOR_RESULTADO' => 'nullable|string|size:1',

            'SUSP_RESULTADO_FINAL' => 'nullable|string|size:1',

            // EMISIONES DE GASES
            'EMIS_TEMP_ACEITE' => 'nullable|numeric',
            'EMIS_RPM' => 'nullable|numeric',
            'EMIS_OPACIDAD' => 'nullable|numeric',

            'EMIS_TEMP_ACEITE_DER' => 'nullable|numeric',
            'EMIS_RPM_DER' => 'nullable|numeric',
            'EMIS_OPACIDAD_DER' => 'nullable|numeric',

            'EMIS_CO_RALENTI' => 'nullable|numeric',
            'EMIS_CO_ACELERACION' => 'nullable|numeric',

            'EMIS_CO2_RALENTI' => 'nullable|numeric',
            'EMIS_CO2_ACELERACION' => 'nullable|numeric',

            'EMIS_HC_RALENTI' => 'nullable|numeric',
            'EMIS_HC_ACELERACION' => 'nullable|numeric',

            'EMIS_RESULTADO' => 'nullable|string|size:1',

            // EMISIONES SONORAS
            'EMIS_SONORA_DB' => 'nullable|numeric',
            'EMIS_SONORA_RESULTADO' => 'nullable|string|size:1',

            // RESULTADO GLOBAL
            'RESULTADO_GLOBAL' => 'nullable|string|size:1',
            'OBSERVACIONES' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'ficha_vehiculo_id.required' => 'El campo ficha_vehiculo_id es obligatorio.',
            'ficha_vehiculo_id.integer' => 'El campo ficha_vehiculo_id debe ser un número entero.',
            // Agregar mensajes de error personalizados si es necesario
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors, 'message' => 'Rectifica los errores en el formulario'], 422));
    }
}
