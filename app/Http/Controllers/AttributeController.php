<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    // Listar todos los atributos del sistema
    public function index()
    {
        return response()->json(Attribute::with('domains')->get());
    }

    // Ver un atributo específico y su manual de uso
    public function show($codigo)
    {
        $attribute = Attribute::where('codigo', $codigo)->with('domains')->firstOrFail();
        return response()->json($attribute);
    }
}