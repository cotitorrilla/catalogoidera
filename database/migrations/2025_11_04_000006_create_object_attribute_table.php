<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('object_attribute', function (Blueprint $table) {
            $table->foreignId('object_id')->constrained('objects')->cascadeOnDelete();
            $table->foreignId('attribute_id')->constrained('attributes')->cascadeOnDelete();
            $table->string('display_name')->nullable(); // "denominacion" en el catálogo
            $table->timestamps();

            $table->primary(['object_id','attribute_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('object_attribute');
    }
};
