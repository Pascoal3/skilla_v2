<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job extends Model {
    use HasUuid;
    protected $table = 'trabalhos';
    
    protected $fillable = [
        'title', 'description', 'budget', 'budget_type',
        'location', 'deadline', 'deadline_label', 'deadline_type',
        'project_type_label', 'experience_level', 'status',
        'is_featured', 'is_urgent', 'is_remote',
        'is_payment_verified', 'accepts_multicaixa', 'proposals_open',
        'views_count', 'interviews_count', 'client_id', 'category_id'
    ];

   
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'trabalho_habilidades');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(JobAttachment::class, 'trabalho_id');
    }

    protected $casts = [
        'is_featured'         => 'boolean',
        'is_urgent'           => 'boolean',
        'is_remote'           => 'boolean',
        'is_payment_verified' => 'boolean',
        'accepts_multicaixa'  => 'boolean',
        'proposals_open'      => 'boolean',
        'budget'              => 'decimal:2',
    ];

    public function deliverables(): HasMany
    {
        return $this->hasMany(JobDeliverable::class);
    }

    public function screeningQuestions(): HasMany
    {
        return $this->hasMany(ScreeningQuestion::class);
    }

    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }

    public function savedBy(): HasMany
    {
        return $this->hasMany(SavedJob::class);
    }
}
