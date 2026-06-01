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
        Schema::create('perfil_habilidades', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('perfil_id')->constrained('perfis')->onDelete('cascade');
            $table->foreignUuid('habilidade_id')->constrained('habilidades')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['perfil_id', 'habilidade_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_habilidades');
    }
};
