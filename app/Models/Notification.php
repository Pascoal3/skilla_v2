<?php

namespace App\Models;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model {
    use HasUuid;
    protected $table = 'notificacoes';
    protected $fillable = ['usuario_id', 'tipo', 'titulo', 'corpo', 'id_referencia', 'tipo_referencia', 'lida'];
}
