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
        Schema::create('highlights', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('freelancer_id')->constrained('perfis')->onDelete('cascade');
            $table->string('status')->default('ativo');
            $table->integer('creditos_gastos');
            $table->timestamp('inicio_em')->useCurrent();
            $table->timestamp('expira_em')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('highlights');
    }
};
