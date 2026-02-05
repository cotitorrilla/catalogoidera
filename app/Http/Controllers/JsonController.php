<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class JsonController extends Controller
{
    /**
     * Carga y devuelve los atributos desde el archivo JSON.
     */
    public function atributos()
    {
        $path = database_path('data/atributos-2025.json');
        
        if (!File::exists($path)) {
            Log::error("Archivo de atributos no encontrado: {$path}");
            return response()->json(['error' => 'Archivo de atributos no encontrado'], 404);
        }

        $content = File::get($path);
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error("Error al decodificar atributos JSON: " . json_last_error_msg());
            return response()->json(['error' => 'Error al procesar el archivo JSON: ' . json_last_error_msg()], 500);
        }

        return response()->json($data)
            ->header('Content-Type', 'application/json; charset=utf-8');
    }

    /**
     * Carga y devuelve el catálogo de objetos desde el archivo JSON.
     */
    public function catalogo()
    {
        $path = database_path('data/catalogo-objetos-2025.json');
        
        if (!File::exists($path)) {
            Log::error("Archivo de catálogo no encontrado: {$path}");
            return response()->json(['error' => 'Archivo de catálogo no encontrado'], 404);
        }

        $content = File::get($path);
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error("Error al decodificar catálogo JSON: " . json_last_error_msg());
            return response()->json(['error' => 'Error al procesar el archivo JSON: ' . json_last_error_msg()], 500);
        }

        return response()->json($data)
            ->header('Content-Type', 'application/json; charset=utf-8');
    }
}
