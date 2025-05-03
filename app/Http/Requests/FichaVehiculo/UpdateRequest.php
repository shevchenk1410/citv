<?php

namespace App\Http\Requests\FichaVehiculo;

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
            'PLACA' => ['required', 'string', 'max:6'],
            'CATEGORIA' => ['required', 'numeric', 'min:0'],
            'TIPAMBITO' => ['required', 'numeric', 'min:0'],
            'TIPSERVICIO' => ['required', 'numeric', 'min:0'],
            'TIPINSPECCION' => ['required', 'numeric', 'min:0'],
            'cliente_id' => ['required', 'numeric', 'min:0'],
            'cliente2_id' => ['numeric', 'min:0'],
            'CATEGORIA_DESC' => ['required', 'string'],
            'MARCA' => ['required', 'string'],
            'MODELO' => ['required', 'string'],
            'ANOFAB' => ['required', 'numeric', 'min:1900', 'max:' . date('Y')],
            'COMBUSTIBLE' => ['required', 'string'],
            'VINSERCHA' => ['required', 'string'],
            'NUMEROMOTOR' => ['required', 'string'],
            'CARROCERIA' => ['required', 'string'],
            'NUMEROEJES' => ['required', 'numeric', 'min:1'],
            'NUMERORUEDAS' => ['required', 'numeric', 'min:2'],
            'NUMEROASIENTOS' => ['required', 'numeric', 'min:0'],
            'NUMEROPASAJEROS' => ['required', 'numeric', 'min:0'],
            'LARGO' => ['required', 'numeric', 'min:0'],
            'ANCHO' => ['required', 'numeric', 'min:0'],
            'ALTO' => ['required', 'numeric', 'min:0'],
            'COLOR' => ['required', 'string'],
            'PESONETO' => ['required', 'numeric', 'min:0'],
            'PESOBRUTO' => ['required', 'numeric', 'min:0'],
            'PESOUTIL' => ['required', 'numeric', 'min:0'],
            'NUMDOC_ULTREV' => ['nullable', 'string'],
            'FECDOC_ULTREV' => ['nullable', 'string'],
            'RAZSOCCITV_ULTREV' => ['nullable', 'string'],
            'OBS_ULTREV' => ['nullable', 'string'],
            //'TIPPOLIZA' => ['nullable', 'string'],
            //'ASEGURADORA' => ['nullable', 'string'],
            //'NUMPOLIZA' => ['nullable', 'string'],
            //'FECINIPOLIZA' => ['nullable', 'date'],
           // 'FECFINPOLIZA' => ['nullable', 'date'],
            'MENSAJE' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
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
            'cliente_id.required' => 'El campo cliente_id es obligatorio',
            'cliente_id.numeric' => 'El campo cliente_id debe ser un número',
            'cliente_id.min' => 'El campo cliente_id debe ser mayor o igual a 0',
            'cliente2_id.numeric' => 'El campo cliente2_id debe ser un número',
            'cliente2_id.min' => 'El campo cliente2_id debe ser mayor o igual a 0',
            'CATEGORIA_DESC.required' => 'La descripción de la categoría es obligatoria',
            'MARCA.required' => 'La marca del vehículo es obligatoria',
            'MODELO.required' => 'El modelo del vehículo es obligatorio',
            'ANOFAB.required' => 'El año de fabricación es obligatorio',
            'ANOFAB.numeric' => 'El año de fabricación debe ser un número',
            'ANOFAB.min' => 'El año de fabricación no es válido',
            'ANOFAB.max' => 'El año de fabricación no puede ser mayor al año actual',
            'COMBUSTIBLE.required' => 'El tipo de combustible es obligatorio',
            'VINSERCHA.required' => 'El número de serie/chasis es obligatorio',
            'NUMEROMOTOR.required' => 'El número de motor es obligatorio',
            'CARROCERIA.required' => 'El tipo de carrocería es obligatorio',
            'NUMEROEJES.required' => 'El número de ejes es obligatorio',
            'NUMEROEJES.numeric' => 'El número de ejes debe ser un número',
            'NUMEROEJES.min' => 'El número de ejes debe ser al menos 1',
            'NUMERORUEDAS.required' => 'El número de ruedas es obligatorio',
            'NUMERORUEDAS.numeric' => 'El número de ruedas debe ser un número',
            'NUMERORUEDAS.min' => 'El número de ruedas debe ser al menos 2',
            'NUMEROASIENTOS.required' => 'El número de asientos es obligatorio',
            'NUMEROASIENTOS.numeric' => 'El número de asientos debe ser un número',
            'NUMEROASIENTOS.min' => 'El número de asientos debe ser mayor o igual a 0',
            'NUMEROPASAJEROS.required' => 'El número de pasajeros es obligatorio',
            'NUMEROPASAJEROS.numeric' => 'El número de pasajeros debe ser un número',
            'NUMEROPASAJEROS.min' => 'El número de pasajeros debe ser mayor o igual a 0',
            'LARGO.required' => 'El largo del vehículo es obligatorio',
            'LARGO.numeric' => 'El largo del vehículo debe ser un número',
            'LARGO.min' => 'El largo del vehículo debe ser mayor a 0',
            'ANCHO.required' => 'El ancho del vehículo es obligatorio',
            'ANCHO.numeric' => 'El ancho del vehículo debe ser un número',
            'ANCHO.min' => 'El ancho del vehículo debe ser mayor a 0',
            'ALTO.required' => 'El alto del vehículo es obligatorio',
            'ALTO.numeric' => 'El alto del vehículo debe ser un número',
            'ALTO.min' => 'El alto del vehículo debe ser mayor a 0',
            'COLOR.required' => 'El color del vehículo es obligatorio',
            'PESONETO.required' => 'El peso neto es obligatorio',
            'PESONETO.numeric' => 'El peso neto debe ser un número',
            'PESONETO.min' => 'El peso neto debe ser mayor a 0',
            'PESOBRUTO.required' => 'El peso bruto es obligatorio',
            'PESOBRUTO.numeric' => 'El peso bruto debe ser un número',
            'PESOBRUTO.min' => 'El peso bruto debe ser mayor a 0',
            'PESOUTIL.required' => 'El peso útil es obligatorio',
            'PESOUTIL.numeric' => 'El peso útil debe ser un número',
            'PESOUTIL.min' => 'El peso útil debe ser mayor a 0',
            //'FECINIPOLIZA.date' => 'La fecha de inicio de la póliza debe ser una fecha válida',
            //'FECFINPOLIZA.date' => 'La fecha de fin de la póliza debe ser una fecha válida',
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
