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
        Schema::create('carteiras', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('usuario_id')->unique()->constrained('perfis')->onDelete('cascade');
            $table->decimal('saldo', 15, 2)->default(0);
            $table->string('tipo')->default('usuario'); // usuario | plataforma
            $table->string('moeda')->default('AOA');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carteiras');
    }
};
