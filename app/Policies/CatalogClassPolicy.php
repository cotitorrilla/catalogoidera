<?php

namespace App\Policies;

use App\Models\CatalogClass;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogClassPolicy
{
    use HandlesAuthorization;

    /**
     * Determinar si el usuario puede ver la lista de clases.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view classes');
    }

    /**
     * Determinar si el usuario puede ver una clase específica.
     */
    public function view(User $user, CatalogClass $class): bool
    {
        return $user->can('view classes');
    }

    /**
     * Determinar si el usuario puede crear clases.
     */
    public function create(User $user): bool
    {
        return $user->can('create classes');
    }

    /**
     * Determinar si el usuario puede actualizar una clase.
     */
    public function update(User $user, CatalogClass $class): bool
    {
        return $user->can('edit classes');
    }

    /**
     * Determinar si el usuario puede eliminar una clase.
     */
    public function delete(User $user, CatalogClass $class): bool
    {
        return $user->can('delete classes');
    }

    /**
     * Determinar si el usuario puede restaurar una clase.
     */
    public function restore(User $user, CatalogClass $class): bool
    {
        return $user->can('delete classes');
    }

    /**
     * Determinar si el usuario puede eliminar permanentemente una clase.
     */
    public function forceDelete(User $user, CatalogClass $class): bool
    {
        return $user->hasRole('admin');
    }
}

