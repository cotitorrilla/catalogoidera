<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClassRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para actualizar una clase.
     */
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'max:10',
                Rule::unique('classes')->ignore($this->route('class')->id),
            ],
            'name' => 'required|max:255',
            'content' => 'nullable',
        ];
    }

    /**
     * Mensajes de error personalizados en español.
     */
    public function messages(): array
    {
        return [
            'code.required' => 'El campo código es obligatorio.',
            'code.unique' => 'Ya existe otra clase con este código.',
            'code.max' => 'El código no puede tener más de 10 caracteres.',
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
        ];
    }

    /**
     * Nombres de atributos personalizados.
     */
    public function attributes(): array
    {
        return [
            'code' => 'código',
            'name' => 'nombre',
            'content' => 'contenido',
        ];
    }
}

