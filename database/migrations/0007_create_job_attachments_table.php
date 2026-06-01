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
        Schema::create('trabalho_anexos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('trabalho_id')
                  ->constrained('trabalhos')
                  ->onDelete('cascade');
            $table->string('nome_arquivo');
            $table->text('url_arquivo');
            $table->integer('tamanho_bytes')->nullable();
            $table->timestamp('criado_em')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabalho_anexos');
    }
};