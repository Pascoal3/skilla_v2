<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Dispute extends Model {
    use HasUuid;
    protected $table = 'disputas';
    protected $fillable = ['Contract_id', 'aberta_por', 'motivo', 'status', 'decisao_admin', 'resolvida_em'];

    public function contract() {
        return $this->belongsTo(Contract::class, 'Contract_id');
    }
}
