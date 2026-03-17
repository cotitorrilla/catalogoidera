<?php

namespace App\Providers;

use App\Models\CatalogClass;
use App\Models\Attribute;
use App\Models\Subcategory;
use App\Models\CatalogObject;
use App\Policies\CatalogClassPolicy;
use App\Policies\AttributePolicy;
use App\Policies\SubcategoryPolicy;
use App\Policies\CatalogObjectPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for your application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        CatalogClass::class => CatalogClassPolicy::class,
        Attribute::class => AttributePolicy::class,
        Subcategory::class => SubcategoryPolicy::class,
        CatalogObject::class => CatalogObjectPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Definir habilidades (permissions) básicas
        // Los usuarios pueden verificar permisos con: $user->can('permission name')
        // Los usuarios pueden verificar roles con: $user->hasRole('role name')
    }
}

