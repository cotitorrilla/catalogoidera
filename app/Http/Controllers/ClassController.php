<?php

namespace App\Http\Controllers;

use App\Models\CatalogClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Muestra la lista de clases.
     */
    public function index()
    {
        $classes = CatalogClass::with('subcategories')->get();
        return view('catalog.classes.list', compact('classes'));
    }

    /**
     * Muestra el formulario para crear una nueva clase.
     */
    public function create()
    {
        return view('catalog.classes.create');
    }

    /**
     * Guarda una nueva clase.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:classes|max:10',
            'name' => 'required|max:255',
            'content' => 'nullable',
        ]);

        CatalogClass::create($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Clase creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una clase.
     */
    public function edit(CatalogClass $class)
    {
        return view('catalog.classes.edit', compact('class'));
    }

    /**
     * Actualiza una clase.
     */
    public function update(Request $request, CatalogClass $class)
    {
        $validated = $request->validate([
            'code' => 'required|max:10|unique:classes,code,' . $class->id,
            'name' => 'required|max:255',
            'content' => 'nullable',
        ]);

        $class->update($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Clase actualizada exitosamente.');
    }

    /**
     * Desactiva una clase (baja lógica).
     */
    public function destroy(CatalogClass $class)
    {
        $class->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Clase desactivada exitosamente.');
    }

    /**
     * Restaura una clase eliminada.
     */
    public function restore($id)
    {
        $class = CatalogClass::withTrashed()->findOrFail($id);
        $class->restore();

        return redirect()->route('classes.index')
            ->with('success', 'Clase restaurada exitosamente.');
    }

    /**
     * Elimina permanentemente una clase.
     */
    public function forceDelete($id)
    {
        $class = CatalogClass::withTrashed()->findOrFail($id);
        
        // Verificar que no tenga subcategorías activas
        if ($class->subcategories()->count() > 0) {
            return redirect()->route('classes.index')
                ->with('error', 'No se puede eliminar permanentemente la clase porque tiene subcategorías asociadas.');
        }

        $class->forceDelete();

        return redirect()->route('classes.index')
            ->with('success', 'Clase eliminada permanentemente.');
    }
}

