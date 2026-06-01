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
        Schema::create('mensagens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('conversa_id')->constrained('conversas')->onDelete('cascade');
            $table->foreignUuid('remetente_id')->constrained('perfis')->onDelete('cascade');
            $table->text('conteudo')->nullable();
            $table->string('tipo_mensagem')->default('texto'); // texto, arquivo
            $table->text('url_arquivo')->nullable();
            $table->string('nome_arquivo')->nullable();
            $table->integer('tamanho_arquivo')->nullable();
            $table->boolean('lida')->default(false);
            $table->timestamp('criado_em')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensagens');
    }
};
