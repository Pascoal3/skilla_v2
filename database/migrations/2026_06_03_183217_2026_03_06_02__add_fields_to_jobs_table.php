<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('status');
            $table->boolean('is_urgent')->default(false)->after('is_featured');
            $table->boolean('is_remote')->default(false)->after('is_urgent');
            $table->boolean('is_payment_verified')->default(false)->after('is_remote');
            $table->boolean('accepts_multicaixa')->default(true)->after('is_payment_verified');
            $table->boolean('proposals_open')->default(true)->after('accepts_multicaixa');
            $table->string('budget_type')->default('fixed')->after('budget');
            $table->string('deadline_type')->nullable()->after('deadline');
            $table->string('deadline_label')->nullable()->after('deadline_type');
            $table->string('project_type_label')->nullable();
            $table->string('experience_level')->nullable();
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedBigInteger('interviews_count')->default(0);
            $table->foreignId('category_id')->nullable()->constrained('job_categories')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn([
                'is_featured', 'is_urgent', 'is_remote',
                'is_payment_verified', 'accepts_multicaixa',
                'proposals_open', 'budget_type', 'deadline_type',
                'deadline_label', 'project_type_label',
                'experience_level', 'views_count', 'interviews_count',
                'category_id'
            ]);
        });
    }
};