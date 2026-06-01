<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model {
    use HasUuid;
    protected $table = 'contratos';
    protected $fillable = [
        'trabalho_id', 'proposta_id', 'cliente_id', 'freelancer_id', 
        'status_contrato', 'valor_acordado', 'comissao_plataforma', 
        'valor_freelancer', 'dias_entrega', 'data_limite', 'status_pagamento'
    ];

    public function job() {
        return $this->belongsTo(Job::class, 'trabalho_id');
    }

    public function proposal() {
        return $this->belongsTo(Proposal::class, 'proposta_id');
    }

    public function client() {
        return $this->belongsTo(Profile::class, 'cliente_id');
    }

    public function freelancer() {
        return $this->belongsTo(Profile::class, 'freelancer_id');
    }
}
