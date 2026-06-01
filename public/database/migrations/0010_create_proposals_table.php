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
        Schema::create('propostas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('trabalho_id')->constrained('trabalhos')->onDelete('cascade');
            $table->foreignUuid('freelancer_id')->constrained('perfis')->onDelete('cascade');
            $table->text('carta_apresentacao');
            $table->float('valor_proposto');
            $table->integer('dias_entrega');
            $table->string('status')->default('pendente'); // pendente, aceita, rejeitada
            $table->integer('creditos_gastos')->default(1);
            $table->timestamps();

            $table->index('trabalho_id');
            $table->index(['freelancer_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propostas');
    }
};
