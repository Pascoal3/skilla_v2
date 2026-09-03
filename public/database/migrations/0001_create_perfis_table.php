<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('perfis', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->string('primeiro_nome');
            $table->string('sobrenome');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('funcao', ['cliente', 'freelancer']);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            
            $table->foreignUuid('provincia_id')
                  ->nullable() 
                  ->constrained('provincias')
                  ->onDelete('set null');

            $table->text('localizacao')->nullable(); 
            $table->text('url_avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('telefone')->nullable();

            $table->integer('saldo_creditos')->default(10);
            $table->boolean('esta_destacado')->default(false);
            $table->timestamp('destaque_expira_em')->nullable();
            $table->float('avaliacao_media')->default(0);
            $table->integer('total_avaliacoes')->default(0);
            $table->integer('total_trabalhos_concluidos')->default(0);
            $table->boolean('esta_ativo')->default(true);
            
            $table->timestamps(); // ← SÓ UMA VEZ (cria created_at + updated_at)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perfis');
    }
};