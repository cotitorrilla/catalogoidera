<?php

namespace App\Policies;

use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubcategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determinar si el usuario puede ver subcategorías.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view subcategories');
    }

    /**
     * Determinar si el usuario puede ver una subcategoría específica.
     */
    public function view(User $user, Subcategory $subcategory): bool
    {
        return $user->can('view subcategories');
    }

    /**
     * Determinar si el usuario puede crear subcategorías.
     */
    public function create(User $user): bool
    {
        return $user->can('create subcategories');
    }

    /**
     * Determinar si el usuario puede actualizar una subcategoría.
     */
    public function update(User $user, Subcategory $subcategory): bool
    {
        return $user->can('edit subcategories');
    }

    /**
     * Determinar si el usuario puede eliminar una subcategoría.
     */
    public function delete(User $user, Subcategory $subcategory): bool
    {
        return $user->can('delete subcategories');
    }

    /**
     * Determinar si el usuario puede restaurar una subcategoría.
     */
    public function restore(User $user, Subcategory $subcategory): bool
    {
        return $user->can('delete subcategories');
    }

    /**
     * Determinar si el usuario puede eliminar permanentemente una subcategoría.
     */
    public function forceDelete(User $user, Subcategory $subcategory): bool
    {
        return $user->hasRole('admin');
    }
}

