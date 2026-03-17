<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Trait RecordsActivity
 * 
 * Proporciona funcionalidad para registrar automáticamente el usuario
 * que crea o modifica un registro.
 * 
 * Uso:
 * 1. Agregar 'created_by' y 'updated_by' al array $fillable del modelo
 * 2. Agregar este trait al modelo: use RecordsActivity;
 * 3. En el controlador, llamar a $model->setCreator() y $model->setEditor()
 */
trait RecordsActivity
{
    /**
     * Boot el trait - registra eventos del modelo
     */
    public static function bootRecordsActivity()
    {
        // Al crear, asignar el usuario actual como creador
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        // Al actualizar, asignar el usuario actual como editor
        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }

    /**
     * Relación con el usuario que creó el registro
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relación con el usuario que actualizó el registro por última vez
     */
    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Obtener el nombre del creador (para usar en vistas)
     */
    public function getCreatorNameAttribute()
    {
        return $this->creator ? $this->creator->name : 'Sistema';
    }

    /**
     * Obtener el nombre del último editor (para usar en vistas)
     */
    public function getEditorNameAttribute()
    {
        return $this->editor ? $this->editor->name : 'Sistema';
    }
}

