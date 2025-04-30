<?php

namespace App\Http\Requests\Menu;

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
            'nombre' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'orden' => ['required', 'integer'],
            'icono' => ['nullable', 'string', 'max:255'],
            'padre_id' => ['nullable', 'integer'],
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'El campo Nombres es obligatorio',
            'nombre.string' => 'El campo Nombres debe ser una cadena de texto',
            'nombre.max' => 'El campo Nombres no debe exceder los 255 caracteres',
            'url.required' => 'El campo URL es obligatorio',
            'url.string' => 'El campo URL debe ser una cadena de texto',
            'url.max' => 'El campo URL no debe exceder los 255 caracteres',
            'icono.required' => 'El campo Icono es obligatorio',
            'icono.string' => 'El campo Icono debe ser una cadena de texto',
            'icono.max' => 'El campo Icono no debe exceder los 255 caracteres',
            'orden.required' => 'El campo Orden es obligatorio',
            'orden.integer' => 'El campo Orden debe ser un número entero',
            'padre_id.integer' => 'El campo Menú Padre debe ser un número entero',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors, 'message' => 'Rectifica los errores en el formulario'], 422)); 
    }
}
