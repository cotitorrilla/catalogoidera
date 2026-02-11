<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['code','name','definition','type','notes'];
    protected $dates = ['deleted_at'];

    /**
     * Relación: Un atributo tiene muchos dominios (valores permitidos).
     */
    public function domains() {
        return $this->hasMany(AttributeDomain::class);
    }

    /**
     * Relación: Un atributo tiene muchos objetos (relación N:M).
     */
    public function objects() {
        return $this->belongsToMany(
            CatalogObject::class,
            'object_attribute',
            'attribute_id',
            'object_id'
        )->withPivot('display_name')->withTimestamps();
    }
}
