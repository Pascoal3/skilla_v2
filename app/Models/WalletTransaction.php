<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model {
    use HasUuid;
    protected $table = 'transacoes_carteiras';
    public $timestamps = false; // Usamos apenas criado_em
    protected $fillable = ['carteira_origem_id', 'carteira_destino_id', 'valor', 'tipo', 'descricao', 'id_referencia', 'status'];
}
