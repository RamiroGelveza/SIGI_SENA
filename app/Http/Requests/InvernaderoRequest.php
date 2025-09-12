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
            'nombre' => 'required|string|max:255|min:3',
            'tamaño' =>'required|integer|max:5000000000|min:3',
            'idFinca' => 'required|exists:fincas,id'

        ];
    }
}
