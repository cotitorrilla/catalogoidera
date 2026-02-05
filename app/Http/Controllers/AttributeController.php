<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Muestra la lista de todos los atributos del catálogo.
     */
    public function index()
    {
        $attributes = Attribute::with('domains')->get();
        return view('catalog.attributes.index', compact('attributes'));
    }

    /**
     * Muestra el detalle de un atributo específico con su manual de uso.
     */
    public function show($codigo)
    {
        $attribute = Attribute::where('code', $codigo)->with('domains')->firstOrFail();
        return view('catalog.attributes.show', compact('attribute'));
    }

    /**
     * API: Devuelve todos los atributos en formato JSON.
     */
    public function apiIndex()
    {
        return response()->json(Attribute::with('domains')->get());
    }

    /**
     * API: Devuelve el detalle de un atributo específico en JSON.
     */
    public function apiShow($codigo)
    {
        $attribute = Attribute::where('code', $codigo)->with('domains')->firstOrFail();
        return response()->json($attribute);
    }
}
