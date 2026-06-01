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
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('usuario_id')->constrained('perfis')->onDelete('cascade');
            $table->string('tipo'); // proposta_recebida, pagamento_liberado, disputa_aberta, etc
            $table->string('titulo');
            $table->text('corpo');
            $table->uuid('id_referencia')->nullable(); // ID do Job ou Contrato
            $table->string('tipo_referencia')->nullable(); // 'Job', 'Contract'
            $table->boolean('lida')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacoes');
    }
};
