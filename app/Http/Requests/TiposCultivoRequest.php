<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TiposCultivoRequest extends FormRequest
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
            'nombre'     => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'cicloDias'  => 'required|integer|min:1',
        ];
    }
    public function messages(): array
{
    return [
        // nombre
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.string'   => 'El nombre debe ser texto.',
        'nombre.min'      => 'El nombre debe tener al menos 3 caracteres.',
        'nombre.max'      => 'El nombre no puede superar los 255 caracteres.',
        'nombre.regex'    => 'El nombre solo puede contener letras.',

        // cicloDias
        'cicloDias.required' => 'El ciclo en días es obligatorio.',
        'cicloDias.integer'  => 'El ciclo en días debe ser un número entero.',
        'cicloDias.min'      => 'El ciclo en días debe ser mayor que 0.',
    ];
}
}
