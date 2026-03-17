<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\RecordsActivity;

class CatalogClass extends Model
{
    use SoftDeletes, RecordsActivity;
    
    protected $table = 'classes';
    protected $fillable = ['code','name','content','created_by','updated_by'];
    protected $dates = ['deleted_at'];

    /**
     * Relación: Una clase tiene muchas subcategorías.
     */
    public function subcategories() {
        return $this->hasMany(Subcategory::class, 'class_id');
    }

    /**
     * Obtiene los colores asociados a esta clase.
     * 
     * @return array Array con las clases CSS de color
     */
    public function getColors(): array
    {
        return getClassColors($this->code);
    }

    /**
     * Obtiene el color base para esta clase.
     * Útil para generar clases dinámicas de Tailwind.
     * 
     * @return string Color base (ej: 'yellow', 'red')
     */
    public function getBaseColor(): string
    {
        return getBaseColor($this->code);
    }
}
