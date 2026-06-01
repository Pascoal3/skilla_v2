<?php

namespace App\Models;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model {
    use HasUuid;
    protected $table = 'conversas';
    protected $fillable = ['contrato_id', 'cliente_id', 'freelancer_id', 'ultima_mensagem_em'];

    public function messages() { return $this->hasMany(Message::class, 'conversa_id'); }
    public function contract() { return $this->belongsTo(Contract::class, 'contrato_id'); }
}
