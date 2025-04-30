<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'dni' => ['required', 'string', 'max:8', 'unique:usuario'],
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:9'],
            'rol_id' => ['required', 'integer', 'exists:rol,id'],
            'sucursal_id' => ['numeric', 'min:0'],
        ];
    }

    public function messages(){
        return [
            'dni.required' => 'El campo DNI es obligatorio',
            'dni.string' => 'El campo DNI debe ser una cadena de texto',
            'dni.max' => 'El campo DNI no debe exceder los 8 caracteres',
            'dni.unique' => 'El DNI ya se encuentra registrado',
            'nombres.required' => 'El campo Nombres es obligatorio',
            'nombres.string' => 'El campo Nombres debe ser una cadena de texto',
            'nombres.max' => 'El campo Nombres no debe exceder los 255 caracteres',
            'apellidos.required' => 'El campo Apellidos es obligatorio',
            'apellidos.string' => 'El campo Apellidos debe ser una cadena de texto',
            'apellidos.max' => 'El campo Apellidos no debe exceder los 255 caracteres',
            'email.email' => 'El campo Email debe ser un correo electrónico',
            'email.max' => 'El campo Email no debe exceder los 255 caracteres',
            'telefono.string' => 'El campo Teléfono debe ser una cadena de texto',
            'telefono.max' => 'El campo Teléfono no debe exceder los 9 caracteres',
            'rol_id.required' => 'El campo Rol es obligatorio',
            'rol_id.integer' => 'El campo Rol debe ser un número entero',
            'rol_id.exists' => 'El Rol seleccionado no existe',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors, 'message' => 'Rectifica los errores en el formulario'], 422)); 
    }
}
