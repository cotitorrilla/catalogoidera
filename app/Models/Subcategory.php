<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['class_id','code','name','content'];

    public function class() {
        return $this->belongsTo(CatalogClass::class, 'class_id');
    }
    public function objects() {
        return $this->hasMany(CatalogObject::class, 'subcategory_id');
    }
}
