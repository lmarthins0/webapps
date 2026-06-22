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
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('dominio');
            $table->string('justificativa');
            $table->string('tipo');
            $table->string('status')->default('Solicitado');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('image_id')->nullable();
            $table->string('stack')->nullable()->unique();
            $table->string('version')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apps');
    }
};
