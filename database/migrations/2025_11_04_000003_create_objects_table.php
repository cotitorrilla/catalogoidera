<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('objects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')->constrained('subcategories')->cascadeOnDelete();
            $table->unsignedInteger('code')->unique();
            $table->string('name');
            $table->string('geometry')->nullable(); // ej. "Punto", "Línea", "Polígono", "Punto/Polígono"
            $table->text('definition')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('objects');
    }
};
