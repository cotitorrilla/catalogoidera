<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\ClassController;
use App\Models\CatalogClass;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $classes = CatalogClass::with('subcategories')->get();
    return view('home', compact('classes'));
})->name('home');

Route::get('/clases', [CatalogController::class, 'index'])
    ->name('classes.index');

// Rutas públicas - solo visualización
Route::get('/clase/{class}/subcategorias', [SubcategoryController::class, 'show'])
    ->name('subcategories.show');

Route::get('/subcategoria/{subcategory}/objetos', [ObjectController::class, 'index'])
    ->name('subcategories.objects.index');

Route::get('/objetos', [ObjectController::class, 'index'])
    ->name('objects.index');

Route::get('/atributos', [AttributeController::class, 'index'])
    ->name('attributes.index');

Route::get('/atributos/{attribute}', [AttributeController::class, 'show'])
    ->name('attributes.show');

Route::get('/objeto/{codigo}', [ObjectController::class, 'show'])
    ->name('objects.show');

// Rutas protegidas - requieren autenticación
Route::middleware(['auth'])->group(function () {
    // Clases - CRUD
    Route::get('/clases/crear', [ClassController::class, 'create'])
        ->name('classes.create');

    Route::post('/clases', [ClassController::class, 'store'])
        ->name('classes.store');

    Route::get('/clase/{class}/editar', [ClassController::class, 'edit'])
        ->name('classes.edit');

    Route::put('/clase/{class}', [ClassController::class, 'update'])
        ->name('classes.update');

    Route::delete('/clase/{class}', [ClassController::class, 'destroy'])
        ->name('classes.destroy');

    // Subcategorías - CRUD
    Route::get('/clase/{class}/subcategorias/crear', [SubcategoryController::class, 'create'])
        ->name('subcategories.create');

    Route::post('/subcategorias', [SubcategoryController::class, 'store'])
        ->name('subcategories.store');

    Route::get('/subcategoria/{subcategory}/editar', [SubcategoryController::class, 'edit'])
        ->name('subcategories.edit');

    Route::put('/subcategoria/{subcategory}', [SubcategoryController::class, 'update'])
        ->name('subcategories.update');

    Route::delete('/subcategoria/{subcategory}', [SubcategoryController::class, 'destroy'])
        ->name('subcategories.destroy');

    // Objetos - CRUD
    Route::get('/objetos/crear', [ObjectController::class, 'create'])
        ->name('objects.create');

    Route::post('/objetos', [ObjectController::class, 'store'])
        ->name('objects.store');

    Route::get('/objeto/{object}/editar', [ObjectController::class, 'edit'])
        ->name('objects.edit');

    Route::put('/objeto/{object}', [ObjectController::class, 'update'])
        ->name('objects.update');

    Route::delete('/objeto/{object}', [ObjectController::class, 'destroy'])
        ->name('objects.destroy');

    // Atributos - CRUD
    Route::get('/atributos/crear', [AttributeController::class, 'create'])
        ->name('attributes.create');

    Route::post('/atributos', [AttributeController::class, 'store'])
        ->name('attributes.store');

    Route::get('/atributos/{attribute}/editar', [AttributeController::class, 'edit'])
        ->name('attributes.edit');

    Route::put('/atributos/{attribute}', [AttributeController::class, 'update'])
        ->name('attributes.update');

    Route::delete('/atributos/{attribute}', [AttributeController::class, 'destroy'])
        ->name('attributes.destroy');

    Route::delete('/atributos/{attribute}/dominios/{domain}', [AttributeController::class, 'destroyDomain'])
        ->name('attributes.domains.destroy');

    // Dashboard y Perfil
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
