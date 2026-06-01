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
        Schema::create('disputas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('contrato_id')->constrained('contratos')->onDelete('cascade');
            $table->foreignUuid('aberta_por')->constrained('perfis')->onDelete('cascade');
            $table->text('motivo');
            // aberta, em_analise, resolvida_cliente, resolvida_freelancer, acordo_mutuo
            $table->string('status')->default('aberta');
            $table->text('decisao_admin')->nullable();
            $table->timestamp('resolvida_em')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disputas');
    }
};
