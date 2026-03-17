<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Agregar created_by y updated_by a classes
        Schema::table('classes', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('content');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_at');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        // Agregar created_by y updated_by a subcategories
        Schema::table('subcategories', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('content');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_at');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        // Agregar created_by y updated_by a objects
        Schema::table('objects', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('definition');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_at');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        // Agregar created_by y updated_by a attributes
        Schema::table('attributes', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->after('notes');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_at');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void {
        // Eliminar created_by y updated_by de classes
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by']);
        });

        // Eliminar created_by y updated_by de subcategories
        Schema::table('subcategories', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by']);
        });

        // Eliminar created_by y updated_by de objects
        Schema::table('objects', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by']);
        });

        // Eliminar created_by y updated_by de attributes
        Schema::table('attributes', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by']);
        });
    }
};

