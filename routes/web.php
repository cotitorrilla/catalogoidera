<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\JsonController;

/*
|--------------------------------------------------------------------------
| Rutas del Catálogo de Objetos Geográficos IDERA
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::get('/', function () {
    return redirect()->route('classes.index');
});

// Rutas para Clases
Route::prefix('clases')->name('classes.')->group(function () {
    Route::get('/', [ClassController::class, 'index'])->name('index');
    Route::get('/create', [ClassController::class, 'create'])->name('create');
    Route::post('/', [ClassController::class, 'store'])->name('store');
    Route::get('/{class}/edit', [ClassController::class, 'edit'])->name('edit');
    Route::put('/{class}', [ClassController::class, 'update'])->name('update');
    Route::delete('/{class}', [ClassController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/restore', [ClassController::class, 'restore'])->name('restore');
    Route::delete('/{id}/force', [ClassController::class, 'forceDelete'])->name('forceDelete');
});

// Rutas para Subcategorías
Route::prefix('subcategorias')->name('subcategories.')->group(function () {
    Route::get('/', [SubcategoryController::class, 'index'])->name('index');
    Route::get('/create', [SubcategoryController::class, 'create'])->name('create');
    Route::post('/', [SubcategoryController::class, 'store'])->name('store');
    Route::get('/{subcategory}/edit', [SubcategoryController::class, 'edit'])->name('edit');
    Route::put('/{subcategory}', [SubcategoryController::class, 'update'])->name('update');
    Route::delete('/{subcategory}', [SubcategoryController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/restore', [SubcategoryController::class, 'restore'])->name('restore');
    Route::delete('/{id}/force', [SubcategoryController::class, 'forceDelete'])->name('forceDelete');
});

// Ruta para mostrar subcategorías de una clase
Route::get('/clases/{class}/subcategorias', [SubcategoryController::class, 'show'])->name('subcategories.show');

// Rutas para Objetos
Route::prefix('objetos')->name('objects.')->group(function () {
    Route::get('/', [ObjectController::class, 'index'])->name('index');
    Route::get('/create', [ObjectController::class, 'create'])->name('create');
    Route::post('/', [ObjectController::class, 'store'])->name('store');
    Route::get('/{objeto}/edit', [ObjectController::class, 'edit'])->name('edit');
    Route::put('/{objeto}', [ObjectController::class, 'update'])->name('update');
    Route::delete('/{objeto}', [ObjectController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/restore', [ObjectController::class, 'restore'])->name('restore');
    Route::delete('/{id}/force', [ObjectController::class, 'forceDelete'])->name('forceDelete');
});

// Ruta para mostrar objetos de una subcategoría
Route::get('/subcategorias/{subcategory}/objetos', [ObjectController::class, 'index'])->name('objects.bySubcategory');

// Ruta para mostrar detalle de un objeto
Route::get('/objetos/{objeto}', [ObjectController::class, 'show'])->name('objects.show');

// Rutas para Atributos
Route::prefix('atributos')->name('attributes.')->group(function () {
    Route::get('/', [AttributeController::class, 'index'])->name('index');
    Route::get('/create', [AttributeController::class, 'create'])->name('create');
    Route::post('/', [AttributeController::class, 'store'])->name('store');
    Route::get('/{attribute}/edit', [AttributeController::class, 'edit'])->name('edit');
    Route::put('/{attribute}', [AttributeController::class, 'update'])->name('update');
    Route::delete('/{attribute}', [AttributeController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/restore', [AttributeController::class, 'restore'])->name('restore');
    Route::delete('/{id}/force', [AttributeController::class, 'forceDelete'])->name('forceDelete');
    Route::delete('/{attribute}/dominios/{domain}', [AttributeController::class, 'destroyDomain'])->name('domains.destroy');
});

// Ruta para mostrar detalle de un atributo
Route::get('/atributos/{attribute}', [AttributeController::class, 'show'])->name('attributes.show');

// Rutas JSON para la API
Route::prefix('json')->name('json.')->group(function () {
    Route::get('/atributos', [JsonController::class, 'atributos'])->name('atributos');
    Route::get('/catalogo', [JsonController::class, 'catalogo'])->name('catalogo');
});

