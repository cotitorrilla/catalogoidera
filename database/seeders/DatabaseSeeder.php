<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador con contraseña encriptada con bcrypt
        // Usa firstOrCreate para evitar errores si el usuario ya existe
        User::firstOrCreate(
            ['email' => 'tengounmailpiola@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'), // Contraseña encriptada con bcrypt
                'email_verified_at' => now(),
            ]
        );

        // Usuario de prueba - solo crear si no existe
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Usuario Prueba',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            AttributesSeeder::class,
            CatalogSeeder::class,
        ]);
    }
}
