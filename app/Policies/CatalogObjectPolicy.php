<?php

namespace App\Policies;

use App\Models\CatalogObject;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogObjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determinar si el usuario puede ver objetos.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view objects');
    }

    /**
     * Determinar si el usuario puede ver un objeto específico.
     */
    public function view(User $user, CatalogObject $object): bool
    {
        return $user->can('view objects');
    }

    /**
     * Determinar si el usuario puede crear objetos.
     */
    public function create(User $user): bool
    {
        return $user->can('create objects');
    }

    /**
     * Determinar si el usuario puede actualizar un objeto.
     */
    public function update(User $user, CatalogObject $object): bool
    {
        return $user->can('edit objects');
    }

    /**
     * Determinar si el usuario puede eliminar un objeto.
     */
    public function delete(User $user, CatalogObject $object): bool
    {
        return $user->can('delete objects');
    }

    /**
     * Determinar si el usuario puede restaurar un objeto.
     */
    public function restore(User $user, CatalogObject $object): bool
    {
        return $user->can('delete objects');
    }

    /**
     * Determinar si el usuario puede eliminar permanentemente un objeto.
     */
    public function forceDelete(User $user, CatalogObject $object): bool
    {
        return $user->hasRole('admin');
    }
}

