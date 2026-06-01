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
        Schema::create('trabalhos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('cliente_id')->constrained('perfis')->onDelete('cascade');
            $table->foreignUuid('categoria_id')->nullable()->constrained('categorias');
            $table->text('titulo')->nullable();
            $table->string('tamanho_projeto')->nullable(); // pequeno, medio, grande
            $table->string('duracao_estimada')->nullable();
            $table->string('nivel_experiencia')->nullable(); // iniciante, intermediario, especialista
            $table->boolean('possibilidade_efetivacao')->default(false);
            $table->string('tipo_trabalho')->nullable(); // preco_fixo, por_hora
            $table->float('orcamento_fixo')->nullable();
            $table->float('taxa_hora_min')->nullable();
            $table->float('taxa_hora_max')->nullable();
            $table->text('descricao')->nullable();

            $table->string('status')->default('rascunho'); // rascunho, aberto, em_andamento, concluido, cancelado, arquivado
            $table->uuid('proposta_aceita_id')->nullable(); // FK para propostas (será criada na fase 4)
            $table->integer('contagem_visualizacoes')->default(0);
    
            $table->date('prazo')->nullable();
            $table->date('expira_em')->nullable();
            $table->timestamps();

            $table->index('cliente_id');
            $table->index('categoria_id');
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabalhos');
    }
};