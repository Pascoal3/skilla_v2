<?php

namespace App\Models;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Message extends Model {
    use HasUuid;
    protected $table = 'mensagens';
    public $timestamps = false; // Usamos criado_em manualmente
    protected $fillable = ['conversa_id', 'remetente_id', 'conteudo', 'tipo_mensagem', 'url_arquivo', 'nome_arquivo', 'tamanho_arquivo', 'lida', 'criado_em'];
}
