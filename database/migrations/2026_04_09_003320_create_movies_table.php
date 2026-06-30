<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nombre de la Película
            $table->text('description')->nullable(); // Descripción
            $table->year('year'); // Año
            $table->json('genres')->nullable(); // Multiselector de Géneros (guardado como JSON)
            $table->string('video_url'); // Enlace del video
            $table->string('poster_portrait')->nullable(); // Imagen Vertical
            $table->string('poster_landscape')->nullable(); // Imagen Horizontal
            $table->boolean('is_visible')->default(true); // Estado (Visible en la web)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
