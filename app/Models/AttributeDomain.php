<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeDomain extends Model
{
    protected $fillable = ['attribute_id','value_code','label','definition','notes'];

    /**
     * Relación: Un dominio pertenece a un atributo.
     */
    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }
}
