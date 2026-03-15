<?php

namespace App\Http\Controllers;

use App\Models\CatalogClass;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Muestra las subcategorías de una clase.
     */
    public function index(CatalogClass $class = null)
    {
        if ($class) {
            $class->load('subcategories.objects');
            return view('catalog.classes.subcategories', compact('class'));
        }
        
        $classes = CatalogClass::with('subcategories')->get();
        return view('catalog.classes.list', compact('classes'));
    }

    /**
     * Muestra las subcategorías de una clase específica.
     */
    public function show(CatalogClass $class)
    {
        $class->load('subcategories.objects');
        return view('catalog.classes.subcategories', compact('class'));
    }

    /**
     * Muestra el formulario para crear una nueva subcategoría.
     */
    public function create(CatalogClass $class = null)
    {
        $classes = CatalogClass::orderBy('code')->get();
        return view('catalog.subcategories.create', compact('class', 'classes'));
    }

    /**
     * Guarda una nueva subcategoría.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'code' => 'required|max:10',
            'name' => 'required|max:255',
            'content' => 'nullable',
        ]);

        // Generar código único para la subcategoría (clase.subcódigo)
        $class = CatalogClass::find($request->class_id);
        $validated['code'] = $class->code . '.' . $request->code;

        Subcategory::create($validated);

        return redirect()->route('subcategories.show', $class)
            ->with('success', 'Subcategoría creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una subcategoría.
     */
    public function edit(Subcategory $subcategory)
    {
        $classes = CatalogClass::orderBy('code')->get();
        return view('catalog.subcategories.edit', compact('subcategory', 'classes'));
    }

    /**
     * Actualiza una subcategoría.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|max:255',
            'content' => 'nullable',
        ]);

        // Actualizar código si cambió la clase
        if ($request->class_id != $subcategory->class_id) {
            $class = CatalogClass::find($request->class_id);
            $validated['code'] = $class->code . '.' . explode('.', $subcategory->code)[1];
        }

        $subcategory->update($validated);

        $class = CatalogClass::find($request->class_id);
        return redirect()->route('subcategories.show', $class)
            ->with('success', 'Subcategoría actualizada exitosamente.');
    }

    /**
     * Desactiva una subcategoría (baja lógica).
     */
    public function destroy(Subcategory $subcategory)
    {
        $class = $subcategory->catalogClass;

        $subcategory->delete();

        return redirect()->route('subcategories.show', $class)
            ->with('success', 'Subcategoría desactivada exitosamente.');
    }

    /**
     * Restaura una subcategoría eliminada.
     */
    public function restore($id)
    {
        $subcategory = Subcategory::withTrashed()->findOrFail($id);
        $subcategory->restore();

        return redirect()->route('subcategories.show', $subcategory->catalogClass)
            ->with('success', 'Subcategoría restaurada exitosamente.');
    }

    /**
     * Elimina permanentemente una subcategoría.
     */
    public function forceDelete($id)
    {
        $subcategory = Subcategory::withTrashed()->findOrFail($id);
        
        if ($subcategory->objects()->count() > 0) {
            return redirect()->route('subcategories.show', $subcategory->catalogClass)
                ->with('error', 'No se puede eliminar permanentemente la subcategoría porque tiene objetos asociados.');
        }

        $subcategory->forceDelete();

        return redirect()->route('subcategories.show', $subcategory->catalogClass)
            ->with('success', 'Subcategoría eliminada permanentemente.');
    }
}

