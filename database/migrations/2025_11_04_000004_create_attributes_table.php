<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 16)->unique(); // ej. FNA, GNA, NAM, etc.
            $table->string('name');
            $table->text('definition')->nullable();
            $table->string('type')->nullable();   // "Cadena de caracteres", "Numérico", "Booleano", "Fecha", etc.
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('attributes');
    }
};
