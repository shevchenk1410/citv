<?php

namespace App\Http\Requests\Rol;

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
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'El campo Nombres es obligatorio',
            'nombre.string' => 'El campo Nombres debe ser una cadena de texto',
            'nombre.max' => 'El campo Nombres no debe exceder los 255 caracteres',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors, 'message' => 'Rectifica los errores en el formulario'], 422)); 
    }
}
