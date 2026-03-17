<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar cache de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos para Classes
        $classPermissions = [
            'view classes',
            'create classes',
            'edit classes',
            'delete classes',
        ];

        // Crear permisos para Attributes
        $attributePermissions = [
            'view attributes',
            'create attributes',
            'edit attributes',
            'delete attributes',
        ];

        // Crear permisos para Subcategories
        $subcategoryPermissions = [
            'view subcategories',
            'create subcategories',
            'edit subcategories',
            'delete subcategories',
        ];

        // Crear permisos para Objects
        $objectPermissions = [
            'view objects',
            'create objects',
            'edit objects',
            'delete objects',
        ];

        $allPermissions = array_merge(
            $classPermissions,
            $attributePermissions,
            $subcategoryPermissions,
            $objectPermissions
        );

        // Crear permisos en la base de datos
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission], [
                'description' => $this->getPermissionDescription($permission)
            ]);
        }

        // Crear roles y asignar permisos
        // Rol Admin: acceso total
        $adminRole = Role::firstOrCreate(['name' => 'admin'], [
            'description' => 'Administrador con acceso total al sistema'
        ]);
        $adminRole->syncPermissions(Permission::all());

        // Rol Editor: puede ver, crear, editar (no eliminar permanentemente)
        $editorRole = Role::firstOrCreate(['name' => 'editor'], [
            'description' => 'Editor puede gestionar contenido'
        ]);
        $editorRole->syncPermissions([
            'view classes', 'create classes', 'edit classes',
            'view attributes', 'create attributes', 'edit attributes',
            'view subcategories', 'create subcategories', 'edit subcategories',
            'view objects', 'create objects', 'edit objects',
        ]);

        // Rol Viewer: solo lectura
        $viewerRole = Role::firstOrCreate(['name' => 'viewer'], [
            'description' => 'Solo puede ver el contenido'
        ]);
        $viewerRole->syncPermissions([
            'view classes',
            'view attributes',
            'view subcategories',
            'view objects',
        ]);

        // Asignar rol Admin al usuario con ID 1 (si existe)
        $adminUser = User::find(1);
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }

        $this->command->info('Roles y permisos creados exitosamente!');
        $this->command->info('Roles: admin, editor, viewer');
        $this->command->info('Permisos: ' . count($allPermissions) . ' permisos configurados');
    }

    /**
     * Obtener descripción del permiso.
     */
    private function getPermissionDescription(string $permission): string
    {
        $descriptions = [
            'view classes' => 'Ver lista de clases',
            'create classes' => 'Crear nuevas clases',
            'edit classes' => 'Editar clases existentes',
            'delete classes' => 'Eliminar (desactivar) clases',
            'view attributes' => 'Ver lista de atributos',
            'create attributes' => 'Crear nuevos atributos',
            'edit attributes' => 'Editar atributos existentes',
            'delete attributes' => 'Eliminar (desactivar) atributos',
            'view subcategories' => 'Ver lista de subcategorías',
            'create subcategories' => 'Crear nuevas subcategorías',
            'edit subcategories' => 'Editar subcategorías existentes',
            'delete subcategories' => 'Eliminar (desactivar) subcategorías',
            'view objects' => 'Ver lista de objetos',
            'create objects' => 'Crear nuevos objetos',
            'edit objects' => 'Editar objetos existentes',
            'delete objects' => 'Eliminar (desactivar) objetos',
        ];

        return $descriptions[$permission] ?? $permission;
    }
}

