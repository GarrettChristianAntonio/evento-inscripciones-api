<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarParticipanteRequest extends FormRequest
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
        'nombre'   => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'dni'      => 'required|string|unique:participantes,dni',
        'email'    => 'required|email|unique:participantes,email',
        ];
    }
    public function messages(): array
    {
        return [
            'nombre.required'   => 'El nombre es obligatorio.',
            'nombre.string'     => 'El nombre debe ser una cadena de texto.',
            'nombre.max'        => 'El nombre no puede tener más de 255 caracteres.',

            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string'   => 'El apellido debe ser una cadena de texto.',
            'apellido.max'      => 'El apellido no puede tener más de 255 caracteres.',

            'dni.required'      => 'El DNI es obligatorio.',
            'dni.string'        => 'El DNI debe ser una cadena de texto.',
            'dni.unique'        => 'Este DNI ya está registrado.',

            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'El correo electrónico debe tener un formato válido.',
            'email.unique'      => 'Este correo electrónico ya está registrado.',
        ];
    }
    public function attributes(): array
    {
        return [
            'email' => 'correo electrónico',
        ];
    }
}
