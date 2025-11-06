<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogClass extends Model
{
    protected $table = 'classes';
    protected $fillable = ['code','name','content'];

    public function subcategories() {
        return $this->hasMany(Subcategory::class, 'class_id');
    }
}
