<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\CatalogObject;
use App\Models\Attribute;
use Illuminate\Http\Request;

class ObjectController extends Controller
{
    /**
     * Muestra los objetos de una subcategoría.
     */
    public function index(Subcategory $subcategory = null)
    {
        if ($subcategory) {
            $subcategory->load('objects', 'catalogClass');
            return view('catalog.subcategories.objects', compact('subcategory'));
        }
        
        return redirect()->route('classes.index');
    }

    /**
     * Muestra el formulario para crear un nuevo objeto.
     */
    public function create(Subcategory $subcategory = null)
    {
        $subcategories = Subcategory::with('catalogClass')->orderBy('code')->get();
        $attributes = Attribute::with('domains')->get();
        return view('catalog.objects.create', compact('subcategory', 'subcategories', 'attributes'));
    }

    /**
     * Guarda un nuevo objeto.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'code' => 'required|max:20',
            'name' => 'required|max:255',
            'geometry' => 'nullable|max:50',
            'definition' => 'nullable',
            'attributes' => 'nullable|array',
        ]);

        // Generar código único: subcategoría.código
        $subcategory = Subcategory::find($request->subcategory_id);
        $validated['code'] = $subcategory->code . '.' . $request->code;

        $object = CatalogObject::create($validated);

        // Adjuntar atributos si se seleccionaron
        if ($request->has('attributes')) {
            $object->attributes()->attach($request->attributes);
        }

        return redirect()->route('objects.index', $subcategory)
            ->with('success', 'Objeto creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un objeto.
     */
    public function edit(CatalogObject $object)
    {
        $subcategories = Subcategory::with('catalogClass')->orderBy('code')->get();
        $attributes = Attribute::with('domains')->get();
        return view('catalog.objects.edit', compact('object', 'subcategories', 'attributes'));
    }

    /**
     * Actualiza un objeto.
     */
    public function update(Request $request, CatalogObject $object)
    {
        $validated = $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|max:255',
            'geometry' => 'nullable|max:50',
            'definition' => 'nullable',
            'attributes' => 'nullable|array',
        ]);

        // Actualizar código si cambió la subcategoría
        if ($request->subcategory_id != $object->subcategory_id) {
            $subcategory = Subcategory::find($request->subcategory_id);
            $validated['code'] = $subcategory->code . '.' . explode('.', $object->code)[1];
        } else {
            // Mantener el código original
            unset($validated['code']);
        }

        $object->update($validated);

        // Sincronizar atributos
        if ($request->has('attributes')) {
            $object->attributes()->sync($request->attributes);
        } else {
            $object->attributes()->detach();
        }

        $subcategory = Subcategory::find($request->subcategory_id);
        return redirect()->route('objects.index', $subcategory)
            ->with('success', 'Objeto actualizado exitosamente.');
    }

    /**
     * Desactiva un objeto (baja lógica).
     */
    public function destroy(CatalogObject $object)
    {
        $subcategory = $object->subcategory;

        $object->delete();

        return redirect()->route('objects.index', $subcategory)
            ->with('success', 'Objeto desactivado exitosamente.');
    }

    /**
     * Restaura un objeto eliminado.
     */
    public function restore($id)
    {
        $object = CatalogObject::withTrashed()->findOrFail($id);
        $object->restore();

        return redirect()->route('objects.index', $object->subcategory)
            ->with('success', 'Objeto restaurado exitosamente.');
    }

    /**
     * Elimina permanentemente un objeto.
     */
    public function forceDelete($id)
    {
        $object = CatalogObject::withTrashed()->findOrFail($id);
        
        // Desvincular atributos
        $object->attributes()->detach();

        $object->forceDelete();

        return redirect()->route('objects.index', $object->subcategory)
            ->with('success', 'Objeto eliminado permanentemente.');
    }

    /**
     * Muestra los detalles de un objeto.
     */
    public function show(CatalogObject $object)
    {
        $object->load('subcategory.catalogClass', 'attributes.domains');
        return view('catalog.objects.detail', compact('object'));
    }
}

