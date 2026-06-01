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
        Schema::create('conversas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('contrato_id')->unique()->constrained('contratos')->onDelete('cascade');
            $table->foreignUuid('cliente_id')->constrained('perfis')->onDelete('cascade');
            $table->foreignUuid('freelancer_id')->constrained('perfis')->onDelete('cascade');
            $table->timestamp('ultima_mensagem_em')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversas');
    }
};
