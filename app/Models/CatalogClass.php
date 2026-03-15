<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogClass extends Model
{
    use SoftDeletes;
    
    protected $table = 'classes';
    protected $fillable = ['code','name','content'];
    protected $dates = ['deleted_at'];

    /**
     * Relación: Una clase tiene muchas subcategorías.
     */
    public function subcategories() {
        return $this->hasMany(Subcategory::class, 'class_id');
    }
}
