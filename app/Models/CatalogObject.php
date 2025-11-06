<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogObject extends Model
{
    protected $table = 'objects';
    protected $fillable = ['subcategory_id','code','name','geometry','definition'];

    public function subcategory() {
        return $this->belongsTo(Subcategory::class);
    }

    public function attributes() {
        return $this->belongsToMany(
            Attribute::class,   // modelo relacionado
            'object_attribute', // tabla pivot
            'object_id',        // FK de ESTE modelo en el pivot
            'attribute_id'      // FK del otro modelo en el pivot
        )->withPivot('display_name')
         ->withTimestamps();
    }
}
