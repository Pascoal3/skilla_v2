<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perfis', function (Blueprint $table) {
            $table->string('nome_usuario')->unique()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('perfis', function (Blueprint $table) {
            $table->dropColumn('nome_usuario');
        });
    }
};