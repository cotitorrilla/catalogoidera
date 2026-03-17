<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDomainRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para crear un dominio de atributo.
     */
    public function rules(): array
    {
        return [
            'value_code' => 'required|max:10',
            'label' => 'required|max:255',
            'definition' => 'nullable',
        ];
    }

    /**
     * Mensajes de error personalizados en español.
     */
    public function messages(): array
    {
        return [
            'value_code.required' => 'El campo código de valor es obligatorio.',
            'value_code.max' => 'El código de valor no puede tener más de 10 caracteres.',
            'label.required' => 'El campo etiqueta es obligatorio.',
            'label.max' => 'La etiqueta no puede tener más de 255 caracteres.',
        ];
    }

    /**
     * Nombres de atributos personalizados.
     */
    public function attributes(): array
    {
        return [
            'value_code' => 'código de valor',
            'label' => 'etiqueta',
            'definition' => 'definición',
        ];
    }
}

