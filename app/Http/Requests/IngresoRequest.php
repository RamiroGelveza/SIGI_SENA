<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoRequest extends FormRequest
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
            'fecha'           => ['required', 'date','before_or_equal:today'],
            'descripcion'     => ['required', 'string', 'min:3', 'max:255'],
            'cantidadVendida' => ['required', 'integer', 'min:1', 'max:1000000'],
            'precioUnitario'  => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'idCosecha'       => ['required', 'exists:cosechas,id'],
        ];
    }
    public function messages()
    {
        return [
            // 📅 Fecha
            'fecha.required' => 'La fecha de la venta es obligatoria.',
            'fecha.date'     => 'La fecha de la venta debe ser válida.',
            'fecha.before_or_equal' => 'Esta fecha no puede ser futura.',


            // 📝 Descripción
            'descripcion.required' => 'La descripción de la venta es obligatoria.',
            'descripcion.string'   => 'La descripción debe ser un texto válido.',
            'descripcion.min'      => 'La descripción debe tener al menos :min caracteres.',
            'descripcion.max'      => 'La descripción no puede superar los :max caracteres.',

            // 📦 Cantidad Vendida
            'cantidadVendida.required' => 'La cantidad vendida es obligatoria.',
            'cantidadVendida.integer'  => 'La cantidad vendida debe ser un número entero.',
            'cantidadVendida.min'      => 'La cantidad vendida mínima es de :min unidades.',
            'cantidadVendida.max'      => 'La cantidad vendida no puede superar :max unidades.',

            // 💰 Precio Unitario
            'precioUnitario.required' => 'El precio unitario es obligatorio.',
            'precioUnitario.numeric'  => 'El precio unitario debe ser un número válido.',
            'precioUnitario.min'      => 'El precio unitario no puede ser negativo.',
            'precioUnitario.max'      => 'El precio unitario no puede superar :max.',

            // 🔗 Relación con cosecha
            'idCosecha.required' => 'Debe seleccionar una cosecha.',
            'idCosecha.exists'   => 'La cosecha seleccionada no existe en el sistema.',
        ];
    }
}
