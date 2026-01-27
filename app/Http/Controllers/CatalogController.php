<?php

namespace App\Http\Controllers;

use App\Models\CatalogClass;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // 1. Listar todas las Clases (Industria, Infraestructura, etc.)
    public function getClasses()
    {
        return response()->json(CatalogClass::all());
    }

    // 2. Listar Subcategorías de una Clase específica
    public function getSubcategories($classId)
    {
        $subcategories = Subcategory::where('catalog_class_id', $classId)->get();
        return response()->json($subcategories);
    }

    // 3. Listar Objetos de una Subcategoría específica
    public function getObjectsBySubcategory($subcategoryId)
    {
        $objects = \App\Models\CatalogObject::where('subcategory_id', $subcategoryId)->get();
        return response()->json($objects);
    }
}