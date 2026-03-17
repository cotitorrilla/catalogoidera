<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateObjectRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para actualizar un objeto.
     */
    public function rules(): array
    {
        return [
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|max:255',
            'geometry' => 'nullable|max:50',
            'definition' => 'nullable',
            'attributes' => 'nullable|array',
        ];
    }

    /**
     * Mensajes de error personalizados en español.
     */
    public function messages(): array
    {
        return [
            'subcategory_id.required' => 'Debe seleccionar una subcategoría.',
            'subcategory_id.exists' => 'La subcategoría seleccionada no es válida.',
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'geometry.max' => 'La geometría no puede tener más de 50 caracteres.',
        ];
    }

    /**
     * Nombres de atributos personalizados.
     */
    public function attributes(): array
    {
        return [
            'subcategory_id' => 'subcategoría',
            'name' => 'nombre',
            'geometry' => 'geometría',
            'definition' => 'definición',
            'attributes' => 'atributos',
        ];
    }
}

