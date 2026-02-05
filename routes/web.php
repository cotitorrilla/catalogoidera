<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CatalogObjectController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\JsonController;

Route::get('/', function () {
    return redirect()->route('classes.index');
});

// Rutas para Clases del Catálogo
Route::get('/clases', [CatalogController::class, 'index'])->name('classes.index');
Route::get('/clases/{class}/subcategorias', [CatalogController::class, 'subcategories'])->name('subcategories.show');

// Rutas para Objetos del Catálogo
Route::get('/subcategorias/{subcategory}/objetos', [CatalogController::class, 'objects'])->name('objects.index');
Route::get('/objetos/{codigo}', [CatalogObjectController::class, 'show'])->name('objects.show');

// Rutas para Atributos
Route::get('/atributos', [AttributeController::class, 'index'])->name('attributes.index');
Route::get('/atributos/{codigo}', [AttributeController::class, 'show'])->name('attributes.show');

// Rutas JSON
Route::get('/json/atributos', [JsonController::class, 'atributos'])->name('json.atributos');
Route::get('/json/catalogo', [JsonController::class, 'catalogo'])->name('json.catalogo');
