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
        Schema::create('habilidades', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('nome')->unique();

            // cada habilidade pertence a uma categoria (idealmente uma SUBCATEGORIA)
            $table->uuid('categoria_id');

            $table->timestamps();

            $table->index('categoria_id');
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habilidades');
    }
};
