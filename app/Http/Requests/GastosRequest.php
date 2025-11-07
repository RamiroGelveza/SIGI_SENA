<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GastosRequest extends FormRequest
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
            'fecha'              => ['required', 'date', 'before_or_equal:today'],
            'descripcion'        => ['required', 'string', 'min:3', 'max:150'],
            'monto'              => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'idCosecha'          => ['required', 'exists:cosechas,id'],
            'idCategoriaGastos'  => ['required', 'exists:categoriaGastos,id'],
        ];
    }
    public function messages()
    {
        return [
            // 📅 Fecha
            'fecha.before_or_equal' => 'Esta fecha no puede ser futura.',
            'fecha.required' => 'La fecha del gasto es obligatoria.',
            'fecha.date'     => 'La fecha del gasto debe ser una fecha válida.',

            // 📝 Descripción
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string'   => 'La descripción debe ser un texto válido.',
            'descripcion.min'      => 'La descripción debe tener al menos :min caracteres.',
            'descripcion.max'      => 'La descripción no puede superar los :max caracteres.',

            // 💰 Monto
            'monto.required' => 'El monto es obligatorio.',
            'monto.numeric'  => 'El monto debe ser un número válido.',
            'monto.min'      => 'El monto no puede ser negativo.',
            'monto.max'      => 'El monto no puede superar :max.',

            // 🔗 Relaciones
            'idCosecha.required' => 'Debe seleccionar una cosecha.',
            'idCosecha.exists'   => 'La cosecha seleccionada no existe en el sistema.',

            'idCategoriaGastos.required' => 'Debe seleccionar una categoría de gastos.',
            'idCategoriaGastos.exists'   => 'La categoría de gastos seleccionada no existe en el sistema.',
        ];
    }
}
