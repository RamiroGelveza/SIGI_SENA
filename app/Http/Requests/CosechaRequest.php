<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CosechaRequest extends FormRequest
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
            'fechaCreacion'        => ['required', 'date','before_or_equal:today'],
            'fechaSiembra'         => ['required', 'date', 'before_or_equal:today'],
            'fechaCosechaEstimada' => ['required', 'date', 'after:fechaSiembra'],
            // 'fechaCosechaReal'     => ['nullable', 'date', 'after_or_equal:fechaSiembra'],

            // 'cantidadSembrada'     => ['required', 'numeric', 'min:1', 'max:100000'],
            // 'totalGastos'          => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            // 'totalIngresos'        => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            // 'utilidad'             => ['nullable', 'numeric', 'min:-99999999.99', 'max:99999999.99'],

            // 'notas'                => ['nullable', 'string', 'max:500'],

            // 'idInvernadero'        => ['required', 'exists:invernaderos,id'],
            // 'idCultivo'            => ['required', 'exists:cultivos,id'],
            // 'idEstado'             => ['required', 'exists:estados,id'],
        ];
    }
    public function messages()
    {
        return [
            // 📅 Fechas
            'fechaCreacion.before_or_equal' => 'La fecha de creación no puede ser futura.',
            'fechaCreacion.required' => 'La fecha de creación es obligatoria.',
            'fechaCreacion.date'     => 'La fecha de creación debe ser válida.',

            'fechaSiembra.required'        => 'La fecha de siembra es obligatoria.',
            'fechaSiembra.date'            => 'La fecha de siembra debe ser válida.',
            'fechaSiembra.before_or_equal' => 'La fecha de siembra no puede ser futura.',

            'fechaCosechaEstimada.required' => 'La fecha de cosecha estimada es obligatoria.',
            'fechaCosechaEstimada.date'     => 'La fecha de cosecha estimada debe ser válida.',
            'fechaCosechaEstimada.after'    => 'La fecha estimada debe ser posterior a la fecha de siembra.',

            'fechaCosechaReal.date'          => 'La fecha de cosecha real debe ser válida.',
            'fechaCosechaReal.after_or_equal'=> 'La fecha real debe ser igual o posterior a la fecha de siembra.',

            // 🌱 Cantidad sembrada
            'cantidadSembrada.required' => 'La cantidad sembrada es obligatoria.',
            'cantidadSembrada.numeric'  => 'La cantidad sembrada debe ser un número entero.',
            'cantidadSembrada.min'      => 'La cantidad sembrada mínima es de :min.',
            'cantidadSembrada.max'      => 'La cantidad sembrada no puede superar :max.',

            // 💰 Totales
            'totalGastos.required' => 'El total de gastos es obligatorio.',
            'totalGastos.numeric'  => 'El total de gastos debe ser un número.',
            'totalGastos.min'      => 'El total de gastos no puede ser negativo.',
            'totalGastos.max'      => 'El total de gastos no puede superar :max.',

            'totalIngresos.required' => 'El total de ingresos es obligatorio.',
            'totalIngresos.numeric'  => 'El total de ingresos debe ser un número.',
            'totalIngresos.min'      => 'El total de ingresos no puede ser negativo.',
            'totalIngresos.max'      => 'El total de ingresos no puede superar :max.',

            'utilidad.numeric' => 'La utilidad debe ser un número.',
            'utilidad.min'     => 'La utilidad mínima permitida es :min.',
            'utilidad.max'     => 'La utilidad máxima permitida es :max.',

            // 📝 Notas
            'notas.string' => 'Las notas deben ser texto.',
            'notas.max'    => 'Las notas no pueden superar los :max caracteres.',

            // 🔗 Relaciones
            'idInvernadero.required' => 'Debe seleccionar un invernadero.',
            'idInvernadero.exists'   => 'El invernadero seleccionado no existe en el sistema.',

            'idCultivo.required' => 'Debe seleccionar un cultivo.',
            'idCultivo.exists'   => 'El cultivo seleccionado no existe en el sistema.',

            'idEstado.required' => 'Debe seleccionar un estado.',
            'idEstado.exists'   => 'El estado seleccionado no existe en el sistema.',
        ];
    }
}
