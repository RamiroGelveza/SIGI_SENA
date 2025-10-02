<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvernaderoRequest extends FormRequest
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
            'nombre'             => 'required|string|min:3|max:255',
            'tamaño'             => 'required|integer|min:1|max:500000',
            'costoConstruccion'  => 'required|numeric|min:0|max:1000000000',
            'rendimiento'        => 'required|numeric|min:0|max:100000',
            'idFinca'            => 'required|exists:fincas,id',

        ];
    }
    public function messages(){
        return[
            // Nombre
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string'   => 'El nombre debe ser un texto válido.',
            'nombre.min'      => 'El nombre debe tener al menos :min caracteres.',
            'nombre.max'      => 'El nombre no puede superar los :max caracteres.',

            // Tamaño
            'tamaño.required' => 'El tamaño es obligatorio.',
            'tamaño.integer'  => 'El tamaño debe ser un número entero.',
            'tamaño.min'      => 'El tamaño debe ser al menos :min.',
            'tamaño.max'      => 'El tamaño no puede superar :max.',

            // Costo Construcción
            'costoConstruccion.required' => 'El costo de construcción es obligatorio.',
            'costoConstruccion.numeric'  => 'El costo de construcción debe ser un número.',
            'costoConstruccion.min'      => 'El costo de construcción no puede ser menor que :min.',
            'costoConstruccion.max'      => 'El costo de construcción no puede superar :max.',

            // Rendimiento
            'rendimiento.required' => 'El rendimiento es obligatorio.',
            'rendimiento.numeric'  => 'El rendimiento debe ser un número.',
            'rendimiento.min'      => 'El rendimiento no puede ser menor que :min.',
            'rendimiento.max'      => 'El rendimiento no puede superar :max.',

            // idFinca
            'idFinca.required' => 'Debe seleccionar una finca.',
            'idFinca.exists'   => 'La finca seleccionada no existe en el sistema.',

        ];
    }
}
