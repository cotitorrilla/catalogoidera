<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Http\Requests\StoreDomainRequest;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Muestra la lista de atributos.
     */
public function index(Request $request)
    {
        $query = Attribute::with('domains');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('code', 'like', '%'.$request->search.'%');
        }

        if ($request->boolean('trashed')) {
            $query->onlyTrashed();
        }

        $attributes = $query->paginate(20);

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
    public function store(StoreAttributeRequest $request)
    {
        $validated = $request->validated();

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
            $domainRequest = new StoreDomainRequest();
            if ($domainRequest->authorize() && $domainRequest->validate($domainRequest->rules())) {
                $validated = $domainRequest->validated();

                $attribute->domains()->create($validated);

                return redirect()->route('attributes.edit', $attribute)
                    ->with('success', 'Dominio agregado exitosamente.');
            }
        }

        return view('catalog.attributes.edit', compact('attribute'));
    }

    /**
     * Actualiza un atributo.
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        $validated = $request->validated();

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
     * Puede buscar por ID o por código.
     */
    public function show(string $attribute)
    {
        // Intentar buscar por ID primero, si no funciona buscar por código
        $attributeModel = Attribute::where('id', $attribute)
            ->orWhere('code', $attribute)
            ->firstOrFail();
        
        $attributeModel->load('domains');
        return view('catalog.attributes.show', compact('attributeModel'));
    }

    /**
     * Agrega un dominio a un atributo.
     */
    public function storeDomain(StoreDomainRequest $request, Attribute $attribute)
    {
        $validated = $request->validated();

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

