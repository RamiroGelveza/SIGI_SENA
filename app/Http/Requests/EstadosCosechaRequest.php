<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadosCosechaRequest extends FormRequest
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
            'nombre' => 'required|string|max:100|min:3|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'
            
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string'   => 'El nombre debe ser un texto válido.',
            'nombre.max'      => 'El nombre no puede superar los :max caracteres.',
            'nombre.min'      => 'El nombre debe tener al menos :min caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras.',
        ];
    }
}
