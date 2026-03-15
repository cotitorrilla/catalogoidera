<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeDomain extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['attribute_id','value_code','label','definition','notes'];
    protected $dates = ['deleted_at'];

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

