<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    use HasUuid;
    protected $table = 'avaliacoes';
    protected $fillable = ['contrato_id', 'avaliador_id', 'avaliado_id', 'nota', 'comentario'];

    public function reviewer() {
        return $this->belongsTo(Profile::class, 'avaliador_id');
    }

    public function reviewed() {
        return $this->belongsTo(Profile::class, 'avaliado_id');
    }
}
