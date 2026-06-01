<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    use HasUuid;
    protected $table = 'trabalhos';
    
    protected $fillable = [
        'cliente_id', 'categoria_id', 'titulo', 'tamanho_projeto', 
        'duracao_estimada', 'nivel_experiencia', 'possibilidade_efetivacao', 
        'tipo_trabalho', 'orcamento_fixo', 'taxa_hora_min', 'taxa_hora_max', 
        'descricao', 'status', 'prazo', 'expira_em'
    ];

    public function client() {
        return $this->belongsTo(Profile::class, 'cliente_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'categoria_id');
    }

    public function skills() {
        return $this->belongsToMany(Skill::class, 'trabalho_habilidades');
    }

    public function attachments() {
        return $this->hasMany(JobAttachment::class, 'trabalho_id');
    }
}
