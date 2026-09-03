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
        Schema::create('categorias', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // permite subcategorias
            $table->uuid('parent_id')->nullable();

            $table->string('nome'); // não único
            $table->string('slug')->unique();

            $table->text('url_icone')->nullable();

            // opcional mas útil na UI
            $table->string('descricao')->nullable();
            $table->unsignedInteger('ordem')->default(0);
            $table->boolean('ativo')->default(true);

            $table->timestamps();

            $table->index('parent_id');

            $table->foreign('parent_id')
                ->references('id')
                ->on('categorias')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
