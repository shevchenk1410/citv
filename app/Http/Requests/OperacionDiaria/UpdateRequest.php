<?php

namespace App\Http\Requests\OperacionDiaria;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:9'],
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'El campo Nombres es obligatorio',
            'nombre.string' => 'El campo Nombres debe ser una cadena de texto',
            'nombre.max' => 'El campo Nombres no debe exceder los 255 caracteres',
            'direccion.required' => 'El campo Apellidos es obligatorio',
            'direccion.string' => 'El campo Apellidos debe ser una cadena de texto',
            'direccion.max' => 'El campo Apellidos no debe exceder los 255 caracteres',
            'email.email' => 'El campo Email debe ser un correo electrónico',
            'email.max' => 'El campo Email no debe exceder los 255 caracteres',
            'telefono.string' => 'El campo Teléfono debe ser una cadena de texto',
            'telefono.max' => 'El campo Teléfono no debe exceder los 9 caracteres',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors, 'message' => 'Rectifica los errores en el formulario'], 422)); 
    }
}
