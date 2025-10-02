<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MantenimientoInvernaderoRequest extends FormRequest
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
            'fechaMantenimiento' => 'required|date|before_or_equal:today',
            'costoMantenimiento' => 'required|numeric|min:0',
            'descripcion'        => 'required|string|max:500',
            'idInvernadero'      => 'required|exists:invernaderos,id',
        ];
    }
    public function messages(): array
    {
        return [
            'fechaMantenimiento.before_or_equal' => 'La fecha de Mantenimiento no puede ser futura.',
            'fechaMantenimiento.required' => 'La fecha de mantenimiento es obligatoria.',
            'fechaMantenimiento.date'     => 'La fecha de mantenimiento debe tener un formato válido.',

            'costoMantenimiento.required' => 'El costo de mantenimiento es obligatorio.',
            'costoMantenimiento.numeric'  => 'El costo de mantenimiento debe ser un número.',
            'costoMantenimiento.min'      => 'El costo de mantenimiento no puede ser negativo.',

            'descripcion.required' => 'La descripción del mantenimiento es obligatoria.',
            'descripcion.string'   => 'La descripción debe ser texto.',
            'descripcion.max'      => 'La descripción no puede superar los 500 caracteres.',

            'idInvernadero.required' => 'Debe seleccionar un invernadero.',
            'idInvernadero.exists'   => 'El invernadero seleccionado no existe.',
        ];
    }
}
