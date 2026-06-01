<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class EscrowTransaction extends Model {
    use HasUuid;
    protected $table = 'transacoes_escrow';
    protected $fillable = [
        'contrato_id', 'carteira_origem_id', 'carteira_destino_id', 
        'valor', 'valor_comissao', 'valor_liquido_freelancer', 
        'status_pagamento', 'metodo_liberacao', 'liberado_em'
    ];
}