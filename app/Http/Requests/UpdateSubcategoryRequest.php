<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubcategoryRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para actualizar una subcategoría.
     */
    public function rules(): array
    {
        return [
            'class_id' => 'required|exists:classes,id',
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
            'class_id.required' => 'Debe seleccionar una clase.',
            'class_id.exists' => 'La clase seleccionada no es válida.',
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
            'class_id' => 'clase',
            'name' => 'nombre',
            'content' => 'contenido',
        ];
    }
}

