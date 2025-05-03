<?php

namespace App\Http\Requests\FichaVehiculo;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePolizaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambia según lógica de permisos
    }

    public function rules(): array
    {
        return [
            'TIPPOLIZA' => 'required|string|max:50',
            'NUMPOLIZA' => 'required|string|max:50',
            'FECINIPOLIZA' => 'required|date',
            'FECFINPOLIZA' => 'required|date|after_or_equal:FECINIPOLIZA',
            'ASEGURADORA' => 'required|int',
        ];
    }


    public function messages(): array
    {
        return [
            'TIPPOLIZA.required' => 'El tipo de póliza es obligatorio.',
            'TIPPOLIZA.string' => 'El tipo de póliza debe ser un texto.',
            'TIPPOLIZA.max' => 'El tipo de póliza no debe exceder los 50 caracteres.',

            'NUMPOLIZA.required' => 'El número de póliza es obligatorio.',
            'NUMPOLIZA.string' => 'El número de póliza debe ser un texto.',
            'NUMPOLIZA.max' => 'El número de póliza no debe exceder los 50 caracteres.',

            'FECINIPOLIZA.required' => 'La fecha de inicio de la póliza es obligatoria.',
            'FECINIPOLIZA.date' => 'La fecha de inicio debe ser una fecha válida.',

            'FECFINPOLIZA.required' => 'La fecha de fin de la póliza es obligatoria.',
            'FECFINPOLIZA.date' => 'La fecha de fin debe ser una fecha válida.',
            'FECFINPOLIZA.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',

            'ASEGURADORA.required' => 'La aseguradora es obligatoria.',
            'ASEGURADORA.string' => 'La aseguradora debe ser un texto.',
            'ASEGURADORA.max' => 'El nombre de la aseguradora no debe exceder los 100 caracteres.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([
            'errors' => $errors,
            'message' => 'Rectifica los errores en el formulario'
        ], 422));
    }
}
