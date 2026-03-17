<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\RecordsActivity;

class Subcategory extends Model
{
    use SoftDeletes, RecordsActivity;
    
    protected $fillable = ['class_id','code','name','content','created_by','updated_by'];
    protected $dates = ['deleted_at'];

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
