<?php

namespace App\Http\Controllers;

use App\Models\CatalogObject;
use Illuminate\Http\Request;

class CatalogObjectController extends Controller
{
    /**
     * Devuelve la ficha técnica completa de un objeto.
     * Incluye geometría, definición y los atributos con sus opciones (dominios).
     */
    public function show($codigo)
    {
        // Buscamos por el código de IDERA (ej: 10101)
        $objeto = CatalogObject::where('codigo', $codigo)
            ->with(['subcategory.catalogClass', 'attributes.domains'])
            ->firstOrFail();

        return response()->json([
            'metadata' => [
                'nombre' => $objeto->nombre,
                'codigo' => $objeto->codigo,
                'geometria' => $objeto->geometria,
                'definicion' => $objeto->definicion,
                'ruta' => $objeto->subcategory->catalogClass->nombre . ' > ' . $objeto->subcategory->nombre
            ],
            // Esto genera los campos del formulario automáticamente
            'atributos' => $objeto->attributes->map(function($attr) {
                return [
                    'codigo' => $attr->codigo,
                    'nombre' => $attr->nombre,
                    'tipo' => $attr->tipo,
                    'definicion' => $attr->definicion,
                    'es_seleccion' => $attr->domains->count() > 0,
                    'opciones' => $attr->domains->map(function($dom) {
                        return [
                            'valor' => $dom->codigo,
                            'texto' => $dom->etiqueta
                        ];
                    })
                ];
            })
        ]);
    }
}