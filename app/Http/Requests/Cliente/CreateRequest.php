<?php

namespace App\Http\Requests\Cliente;

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
            'tipo_documento_id' => 'required|numeric|min:1',
            'numero_documento' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required_unless:tipo_documento_id,6',
            'telefono' => 'nullable',
            'email' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'tipo_documento_id.required' => 'El campo tipo de documento es obligatorio',
            'numero_documento.required' => 'El campo número de documento es obligatorio',
            'nombres.required' => 'El campo nombres es obligatorio',
            'apellidos.required_unless' => 'El campo apellidos es obligatorio',
        ];
    }

    // Override the failedValidation method to return a JSON response with the errors
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors], 422)); 
    }
}
