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
        Schema::create('transacoes_escrow', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('contrato_id')->constrained('contratos')->onDelete('cascade');
            $table->foreignUuid('carteira_origem_id')->constrained('carteiras');
            $table->foreignUuid('carteira_destino_id')->constrained('carteiras');
            $table->decimal('valor', 15, 2);
            $table->decimal('valor_comissao', 15, 2);
            $table->decimal('valor_liquido_freelancer', 15, 2);
            $table->string('status_pagamento')->default('retido'); // retido | liberado | devolvido_cliente
            $table->string('metodo_liberacao')->nullable(); // aprovacao_cliente | decisao_admin
            $table->timestamp('retido_em')->useCurrent();
            $table->timestamp('liberado_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes_escrow');
    }
};
