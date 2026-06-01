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
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('contrato_id')->constrained('contratos')->onDelete('cascade');
            $table->foreignUuid('avaliador_id')->constrained('perfis')->onDelete('cascade');
            $table->foreignUuid('avaliado_id')->constrained('perfis')->onDelete('cascade');
            $table->integer('nota'); // 1 a 5
            $table->text('comentario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
