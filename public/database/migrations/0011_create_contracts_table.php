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
        Schema::create('contratos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('trabalho_id')->constrained('trabalhos')->onDelete('cascade');
            $table->foreignUuid('proposta_id')->constrained('propostas')->onDelete('cascade');
            $table->foreignUuid('cliente_id')->constrained('perfis')->onDelete('cascade');
            $table->foreignUuid('freelancer_id')->constrained('perfis')->onDelete('cascade');

            $table->string('status_contrato')->default('ativo'); // ativo, em_disputa, concluido, cancelado
            $table->float('valor_acordado');
            $table->float('comissao_plataforma')->nullable();
            $table->float('valor_freelancer')->nullable();
    
            $table->integer('dias_entrega');
            $table->date('data_limite')->nullable();
            $table->string('status_pagamento')->default('pendente'); // pendente, retido, liberado, devolvido_cliente
    
            $table->timestamp('trabalho_entregue_em')->nullable();
            $table->timestamp('aprovado_em')->nullable();
            $table->timestamps();

            $table->index('cliente_id');
            $table->index('freelancer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
