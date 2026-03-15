<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Agregar campo deleted_at a classes
        Schema::table('classes', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Agregar campo deleted_at a subcategories
        Schema::table('subcategories', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Agregar campo deleted_at a objects
        Schema::table('objects', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Agregar campo deleted_at a attributes
        Schema::table('attributes', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Agregar campo deleted_at a attribute_domains
        Schema::table('attribute_domains', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('subcategories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('objects', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('attributes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('attribute_domains', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};

