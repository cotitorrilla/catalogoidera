<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Muestra la lista de atributos.
     */
    public function index()
    {
        $attributes = Attribute::with('domains')->get();
        return view('catalog.attributes.index', compact('attributes'));
    }

    /**
     * Muestra el formulario para crear un nuevo atributo.
     */
    public function create()
    {
        return view('catalog.attributes.create');
    }

    /**
     * Guarda un nuevo atributo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:attributes|max:10',
            'name' => 'required|max:255',
            'definition' => 'nullable',
        ]);

        $attribute = Attribute::create($validated);

        return redirect()->route('attributes.index')
            ->with('success', 'Atributo creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un atributo.
     */
    public function edit(Attribute $attribute, Request $request)
    {
        $attribute->load('domains');

        // Si viene una solicitud para agregar dominio
        if ($request->has('add_domain')) {
            $validated = $request->validate([
                'value_code' => 'required|max:10',
                'label' => 'required|max:255',
                'definition' => 'nullable',
            ]);

            $attribute->domains()->create($validated);

            return redirect()->route('attributes.edit', $attribute)
                ->with('success', 'Dominio agregado exitosamente.');
        }

        return view('catalog.attributes.edit', compact('attribute'));
    }

    /**
     * Actualiza un atributo.
     */
    public function update(Request $request, Attribute $attribute)
    {
        $validated = $request->validate([
            'code' => 'required|max:10|unique:attributes,code,' . $attribute->id,
            'name' => 'required|max:255',
            'definition' => 'nullable',
        ]);

        $attribute->update($validated);

        return redirect()->route('attributes.index')
            ->with('success', 'Atributo actualizado exitosamente.');
    }

    /**
     * Desactiva un atributo (baja lógica).
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('attributes.index')
            ->with('success', 'Atributo desactivado exitosamente.');
    }

    /**
     * Restaura un atributo eliminado.
     */
    public function restore($id)
    {
        $attribute = Attribute::withTrashed()->findOrFail($id);
        $attribute->restore();

        return redirect()->route('attributes.index')
            ->with('success', 'Atributo restaurado exitosamente.');
    }

    /**
     * Elimina permanentemente un atributo.
     */
    public function forceDelete($id)
    {
        $attribute = Attribute::withTrashed()->findOrFail($id);
        
        // Desvincular de objetos
        $attribute->objects()->detach();

        // Eliminar dominios
        $attribute->domains()->delete();

        $attribute->forceDelete();

        return redirect()->route('attributes.index')
            ->with('success', 'Atributo eliminado permanentemente.');
    }

    /**
     * Muestra los detalles de un atributo.
     */
    public function show(Attribute $attribute)
    {
        $attribute->load('domains');
        return view('catalog.attributes.show', compact('attribute'));
    }

    /**
     * Agrega un dominio a un atributo.
     */
    public function storeDomain(Request $request, Attribute $attribute)
    {
        $validated = $request->validate([
            'value_code' => 'required|max:10',
            'label' => 'required|max:255',
            'definition' => 'nullable',
        ]);

        $attribute->domains()->create($validated);

        return redirect()->route('attributes.edit', $attribute)
            ->with('success', 'Dominio agregado exitosamente.');
    }

    /**
     * Elimina un dominio.
     */
    public function destroyDomain(Attribute $attribute, $domainId)
    {
        $attribute->domains()->where('id', $domainId)->delete();

        return redirect()->route('attributes.edit', $attribute)
            ->with('success', 'Dominio eliminado.');
    }
}

