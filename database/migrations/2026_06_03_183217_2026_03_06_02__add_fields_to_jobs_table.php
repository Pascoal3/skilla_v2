<?php
// database/migrations/xxxx_add_fields_to_jobs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {

            // ── Booleanos ──────────────────────────────────────────────
            if (!Schema::hasColumn('jobs', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
            if (!Schema::hasColumn('jobs', 'is_urgent')) {
                $table->boolean('is_urgent')->default(false);
            }
            if (!Schema::hasColumn('jobs', 'is_remote')) {
                $table->boolean('is_remote')->default(false);
            }
            if (!Schema::hasColumn('jobs', 'is_payment_verified')) {
                $table->boolean('is_payment_verified')->default(false);
            }
            if (!Schema::hasColumn('jobs', 'accepts_multicaixa')) {
                $table->boolean('accepts_multicaixa')->default(true);
            }
            if (!Schema::hasColumn('jobs', 'proposals_open')) {
                $table->boolean('proposals_open')->default(true);
            }

            // ── Orçamento ──────────────────────────────────────────────
            if (!Schema::hasColumn('jobs', 'budget_type')) {
                $table->string('budget_type')->default('fixed');
            }

            // ── Prazo ──────────────────────────────────────────────────
            if (!Schema::hasColumn('jobs', 'deadline_type')) {
                $table->string('deadline_type')->nullable();
            }
            if (!Schema::hasColumn('jobs', 'deadline_label')) {
                $table->string('deadline_label')->nullable();
            }

            // ── Projeto ────────────────────────────────────────────────
            if (!Schema::hasColumn('jobs', 'project_type_label')) {
                $table->string('project_type_label')->nullable();
            }
            if (!Schema::hasColumn('jobs', 'experience_level')) {
                $table->string('experience_level')->nullable();
            }

            // ── Contadores ─────────────────────────────────────────────
            if (!Schema::hasColumn('jobs', 'views_count')) {
                $table->unsignedBigInteger('views_count')->default(0);
            }
            if (!Schema::hasColumn('jobs', 'interviews_count')) {
                $table->unsignedBigInteger('interviews_count')->default(0);
            }

            // ── Categoria ──────────────────────────────────────────────
            if (!Schema::hasColumn('jobs', 'category_id')) {
                // Só adiciona a FK se a tabela job_categories existir
                if (Schema::hasTable('job_categories')) {
                    $table->foreignId('category_id')
                          ->nullable()
                          ->constrained('job_categories')
                          ->nullOnDelete();
                } else {
                    // Adiciona apenas a coluna sem FK por agora
                    $table->unsignedBigInteger('category_id')->nullable();
                }
            }

            // ── Status (caso não exista ainda) ─────────────────────────
            if (!Schema::hasColumn('jobs', 'status')) {
                $table->string('status')->default('open');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {

            // Remover FK antes da coluna
            if (Schema::hasColumn('jobs', 'category_id')) {
                try {
                    $table->dropForeign(['category_id']);
                } catch (\Exception $e) {
                    // ignora se FK não existir
                }
                $table->dropColumn('category_id');
            }

            $columns = [
                'is_featured', 'is_urgent', 'is_remote',
                'is_payment_verified', 'accepts_multicaixa',
                'proposals_open', 'budget_type', 'deadline_type',
                'deadline_label', 'project_type_label',
                'experience_level', 'views_count', 'interviews_count',
                'status',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('jobs', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};