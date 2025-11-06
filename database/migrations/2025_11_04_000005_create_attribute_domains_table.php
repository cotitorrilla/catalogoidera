<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('attribute_domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained('attributes')->cascadeOnDelete();
            $table->integer('value_code'); // en los JSON suele ser int; si necesitaras alfanumérico, cámbialo a string
            $table->string('label')->nullable();
            $table->text('definition')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['attribute_id','value_code']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('attribute_domains');
    }
};
