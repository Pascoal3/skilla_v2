<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contadores', function (Blueprint $table) {
            $table->id();
            $table->string('chave', 100)->unique();
            $table->unsignedBigInteger('valor_atual')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contadores');
    }
};