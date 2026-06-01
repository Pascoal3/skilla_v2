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
        Schema::create('itens_portfolio', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('freelancer_id')->constrained('perfis')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->text('url_imagem');
            $table->text('url_projeto')->nullable();
            $table->foreignUuid('categoria_id')->nullable()->constrained('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_portfolio');
    }
};
