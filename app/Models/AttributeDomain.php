<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeDomain extends Model
{
    protected $fillable = ['attribute_id','value_code','label','definition','notes'];

    /**
     * Accessor para usar 'code' como alias de 'value_code'.
     */
    public function getCodeAttribute()
    {
        return $this->value_code;
    }

    /**
     * Relación: Un dominio pertenece a un atributo.
     */
    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }
}

