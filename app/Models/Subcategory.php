<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['class_id','code','name','content'];

    /**
     * Relación: Una subcategoría pertenece a una clase.
     */
    public function class() {
        return $this->belongsTo(CatalogClass::class, 'class_id');
    }

    /**
     * Relación: Alias para acceder a la clase del catálogo (utilizado en vistas).
     */
    public function catalogClass() {
        return $this->belongsTo(CatalogClass::class, 'class_id');
    }

    /**
     * Relación: Una subcategoría tiene muchos objetos.
     */
    public function objects() {
        return $this->hasMany(CatalogObject::class, 'subcategory_id');
    }
}
