<?php

namespace App\Policies;

use App\Models\Attribute;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttributePolicy
{
    use HandlesAuthorization;

    /**
     * Determinar si el usuario puede ver la lista de atributos.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view attributes');
    }

    /**
     * Determinar si el usuario puede ver un atributo específico.
     */
    public function view(User $user, Attribute $attribute): bool
    {
        return $user->can('view attributes');
    }

    /**
     * Determinar si el usuario puede crear atributos.
     */
    public function create(User $user): bool
    {
        return $user->can('create attributes');
    }

    /**
     * Determinar si el usuario puede actualizar un atributo.
     */
    public function update(User $user, Attribute $attribute): bool
    {
        return $user->can('edit attributes');
    }

    /**
     * Determinar si el usuario puede eliminar un atributo.
     */
    public function delete(User $user, Attribute $attribute): bool
    {
        return $user->can('delete attributes');
    }

    /**
     * Determinar si el usuario puede restaurar un atributo.
     */
    public function restore(User $user, Attribute $attribute): bool
    {
        return $user->can('delete attributes');
    }

    /**
     * Determinar si el usuario puede eliminar permanentemente un atributo.
     */
    public function forceDelete(User $user, Attribute $attribute): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determinar si el usuario puede agregar dominios a un atributo.
     */
    public function addDomain(User $user, Attribute $attribute): bool
    {
        return $user->can('edit attributes');
    }

    /**
     * Determinar si el usuario puede eliminar dominios de un atributo.
     */
    public function removeDomain(User $user, Attribute $attribute): bool
    {
        return $user->can('edit attributes');
    }
}

