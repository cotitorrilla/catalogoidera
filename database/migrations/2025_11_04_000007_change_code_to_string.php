<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Cambiar code de classes de unsignedInteger a string
        Schema::table('classes', function (Blueprint $table) {
            $table->string('code', 10)->change();
        });

        // Cambiar code de subcategories de unsignedInteger a string
        Schema::table('subcategories', function (Blueprint $table) {
            $table->string('code', 20)->change();
        });

        // Cambiar code de objects de unsignedInteger a string
        Schema::table('objects', function (Blueprint $table) {
            $table->string('code', 30)->change();
        });

        // Cambiar code de attributes de unsignedInteger a string
        Schema::table('attributes', function (Blueprint $table) {
            $table->string('code', 10)->change();
        });
    }

    public function down(): void
    {
        // Revertir a unsignedInteger (puede perder datos si los códigos no son numéricos)
        Schema::table('classes', function (Blueprint $table) {
            $table->unsignedInteger('code')->change();
        });

        Schema::table('subcategories', function (Blueprint $table) {
            $table->unsignedInteger('code')->change();
        });

        Schema::table('objects', function (Blueprint $table) {
            $table->unsignedInteger('code')->change();
        });

        Schema::table('attributes', function (Blueprint $table) {
            $table->unsignedInteger('code')->change();
        });
    }
};

