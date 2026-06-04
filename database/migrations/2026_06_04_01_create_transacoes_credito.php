<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transacoes_credito', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('perfil_id');
            $table->integer('quantidade');
            $table->string('tipo');
            $table->text('descricao')->nullable();
            $table->uuid('id_referencia')->nullable();
            $table->string('tipo_referencia')->nullable();
            $table->timestamp('criado_em')->useCurrent();

            $table->foreign('perfil_id')->references('id')->on('perfis')->cascadeOnDelete();
            $table->index(['perfil_id', 'tipo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacoes_credito');
    }
};