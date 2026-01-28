<?php

namespace App\Http\Controllers;

use App\Models\CatalogClass;
use App\Models\Subcategory;
use App\Models\CatalogObject;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Muestra la lista de todas las clases del catálogo.
     */
    public function index()
    {
        $classes = CatalogClass::with('subcategories')->get();
        return view('catalog.classes.index', compact('classes'));
    }

    /**
     * Muestra las subcategorías de una clase específica.
     */
    public function subcategories(CatalogClass $class)
    {
        $class->load('subcategories.objects');
        return view('catalog.subcategories.show', compact('class'));
    }

    /**
     * Muestra los objetos de una subcategoría específica.
     */
    public function objects(Subcategory $subcategory)
    {
        $subcategory->load('objects', 'catalogClass');
        return view('catalog.objects.index', compact('subcategory'));
    }

    /**
     * API: Devuelve todas las clases en formato JSON.
     */
    public function getClasses()
    {
        return response()->json(CatalogClass::all());
    }

    /**
     * API: Devuelve las subcategorías de una clase específica.
     */
    public function getSubcategories($classId)
    {
        $subcategories = Subcategory::where('catalog_class_id', $classId)->get();
        return response()->json($subcategories);
    }

    /**
     * API: Devuelve los objetos de una subcategoría específica.
     */
    public function getObjectsBySubcategory($subcategoryId)
    {
        $objects = CatalogObject::where('subcategory_id', $subcategoryId)->get();
        return response()->json($objects);
    }
}
