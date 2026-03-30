<?php

namespace App\Http\Controllers;

use App\Models\CatalogClass;
use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Muestra la lista de clases.
     */
public function index(Request $request)
    {
        $query = CatalogClass::with([
            'subcategories' => function($q) {
                $q->withTrashed()->with([
                    'objects' => fn($o) => $o->withTrashed()->with('attributes'),
                ]);
            }
        ]);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('code', 'like', '%'.$request->search.'%');
        }

        if ($request->boolean('trashed')) {
            $query->onlyTrashed();
        }

        $classes = $query->paginate(20);

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
    public function store(StoreClassRequest $request)
    {
        $validated = $request->validated();

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
    public function update(UpdateClassRequest $request, CatalogClass $class)
    {
        $validated = $request->validated();

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

    /**
     * Muestra detalles de la clase con sus subcategorías.
     */
    public function show(Request $request, CatalogClass $class)
    {
        $query = $class->subcategories()->withTrashed();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('code', 'like', '%'.$request->search.'%');
        }

        if ($request->boolean('trashed')) {
            $query->onlyTrashed();
        }

        $subcategories = $query->paginate(20);

        return view('catalog.classes.show', compact('class', 'subcategories'));
    }
}

