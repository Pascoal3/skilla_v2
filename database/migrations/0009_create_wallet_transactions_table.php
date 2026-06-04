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

            $table->foreignUuid('carteira_origem_id')
                ->nullable()
                ->constrained('carteiras');

            $table->foreignUuid('carteira_destino_id')
                ->nullable()
                ->constrained('carteiras');

            $table->decimal('valor', 15, 2);

            $table->string('tipo');
            // recarga | debito_escrow | credito_escrow | reembolso_escrow
            // saque | comissao | compra_creditos

            $table->string('metodo_pagamento')
                ->default('interno');

            $table->text('descricao')
                ->nullable();

            $table->uuid('id_referencia')
                ->nullable();

            // NOVO CAMPO
            $table->string('tipo_referencia')
                ->nullable();
            // contrato | escrow | compra_creditos | saque

            $table->string('status')
                ->default('concluido');
            // pendente | concluido | falhou

            $table->timestamp('criado_em')
                ->useCurrent();

            // NOVO ÍNDICE COMPOSTO
            $table->index([
                'carteira_origem_id',
                'carteira_destino_id'
            ], 'idx_carteiras_origem_destino');
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