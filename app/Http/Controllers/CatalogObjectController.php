<?php

namespace App\Http\Controllers;

use App\Models\CatalogObject;
use Illuminate\Http\Request;

class CatalogObjectController extends Controller
{
    /**
     * Muestra la ficha técnica completa de un objeto geográfico.
     */
    public function show($codigo)
    {
        $objeto = CatalogObject::where('code', $codigo)
            ->with(['subcategory.catalogClass', 'attributes.domains'])
            ->firstOrFail();

        return view('catalog.objects.detail', compact('objeto'));
    }

    /**
     * API: Devuelve la ficha técnica completa de un objeto en JSON.
     * Incluye geometría, definición y los atributos con sus opciones (dominios).
     */
    public function apiShow($codigo)
    {
        $objeto = CatalogObject::where('code', $codigo)
            ->with(['subcategory.catalogClass', 'attributes.domains'])
            ->firstOrFail();

        return response()->json([
            'metadata' => [
                'name' => $objeto->name,
                'code' => $objeto->code,
                'geometry' => $objeto->geometry,
                'definition' => $objeto->definition,
                'ruta' => $objeto->subcategory->catalogClass->name . ' > ' . $objeto->subcategory->name
            ],
            'atributos' => $objeto->attributes->map(function($attr) {
                return [
                    'code' => $attr->code,
                    'name' => $attr->name,
                    'type' => $attr->type,
                    'definition' => $attr->definition,
                    'es_seleccion' => $attr->domains->count() > 0,
                    'opciones' => $attr->domains->map(function($dom) {
                        return [
                            'valor' => $dom->code,
                            'texto' => $dom->label
                        ];
                    })
                ];
            })
        ]);
    }
}

