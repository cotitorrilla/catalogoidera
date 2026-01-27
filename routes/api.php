<?php
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CatalogObjectController;
use App\Http\Controllers\AttributeController;

// Rutas del Navegador
Route::get('/clases', [CatalogController::class, 'getClasses']);
Route::get('/clase/{id}/subcategorias', [CatalogController::class, 'getSubcategories']);
Route::get('/subcategoria/{id}/objetos', [CatalogController::class, 'getObjectsBySubcategory']);

// Ruta de la Ficha Técnica (El Catalogador)
Route::get('/objeto/{codigo}', [CatalogObjectController::class, 'show']);

// Rutas del Diccionario
Route::get('/atributos', [AttributeController::class, 'index']);
