<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['code','name','definition','type','notes'];

    public function domains() {
        return $this->hasMany(AttributeDomain::class);
    }
    public function objects() {
    return $this->belongsToMany(
        CatalogObject::class,
        'object_attribute',
        'attribute_id',
        'object_id'
    )->withPivot('display_name')->withTimestamps();
}

}
