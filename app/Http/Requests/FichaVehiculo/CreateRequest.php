<?php

namespace App\Http\Requests\FichaVehiculo;

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
            'PLACA' => ['required', 'string', 'max:6'],
            'CATEGORIA' => ['numeric', 'min:0'],
            'TIPAMBITO' => ['numeric', 'min:0'],
            'TIPSERVICIO' => ['numeric', 'min:0'],
            'TIPINSPECCION' => ['numeric', 'min:0'],
        ];
    }

    public function messages(){
        return [
            'PLACA.required' => 'El campo PLACA es obligatorio',
            'PLACA.string' => 'El campo PLACA debe ser una cadena de texto',
            'PLACA.max' => 'El campo PLACA no debe exceder los 6 caracteres',
            'CATEGORIA.required' => 'El campo CATEGORIA es obligatorio',
            'CATEGORIA.numeric' => 'El campo CATEGORIA debe ser un número',
            'CATEGORIA.min' => 'El campo CATEGORIA debe ser mayor o igual a 0',
            'TIPAMBITO.required' => 'El campo TIPAMBITO es obligatorio',
            'TIPAMBITO.numeric' => 'El campo TIPAMBITO debe ser un número',
            'TIPAMBITO.min' => 'El campo TIPAMBITO debe ser mayor o igual a 0',
            'TIPSERVICIO.required' => 'El campo TIPSERVICIO es obligatorio',
            'TIPSERVICIO.numeric' => 'El campo TIPSERVICIO debe ser un número',
            'TIPSERVICIO.min' => 'El campo TIPSERVICIO debe ser mayor o igual a 0',
            'TIPINSPECCION.required' => 'El campo TIPINSPECCION es obligatorio',
            'TIPINSPECCION.numeric' => 'El campo TIPINSPECCION debe ser un número',
            'TIPINSPECCION.min' => 'El campo TIPINSPECCION debe ser mayor o igual a 0',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors, 'message' => 'Rectifica los errores en el formulario'], 422)); 
    }
}
