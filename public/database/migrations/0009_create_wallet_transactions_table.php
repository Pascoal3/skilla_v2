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
        Schema::create('transacoes_carteiras', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('carteira_origem_id')->nullable()->constrained('carteiras');
            $table->foreignUuid('carteira_destino_id')->nullable()->constrained('carteiras');
            $table->decimal('valor', 15, 2);
            $table->string('tipo'); // recarga | debito_escrow | credito_escrow | reembolso_escrow | saque | comissao
            $table->string('metodo_pagamento')->default('interno');
            $table->text('descricao')->nullable();
            $table->uuid('id_referencia')->nullable(); // ID do contrato ou da transação escrow
            $table->string('status')->default('concluido'); // pendente | concluido | falhou
            $table->timestamp('criado_em')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes_carteiras');
    }
};
