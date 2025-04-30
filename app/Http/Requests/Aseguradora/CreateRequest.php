<?php

namespace App\Http\Requests\Aseguradora;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'descripcion' => ['required', 'string'],
            'tipo_poliza_id' => ['required', 'integer', 'exists:tipo_poliza,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'descripcion.required' => 'La descripción es requerida',
            'descripcion.string' => 'La descripción debe ser un texto',
            'tipo_poliza_id.required' => 'El tipo de póliza es requerido',
            'tipo_poliza_id.integer' => 'El tipo de póliza debe ser un número entero',
            'tipo_poliza_id.exists' => 'El tipo de póliza no existe',
        ];
    }

    // Override the failedValidation method to return a JSON response with the errors
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors], 422)); 
    }
}
