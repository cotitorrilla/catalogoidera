<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
            $table->unsignedInteger('code');
            $table->string('name');
            $table->text('content')->nullable();
            $table->timestamps();

            $table->unique(['class_id','code']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('subcategories');
    }
};
