<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class JobAttachment extends Model {
    use HasUuid;
    protected $table = 'trabalho_anexos';
    protected $fillable = ['trabalho_id', 'nome_arquivo', 'url_arquivo', 'tamanho_bytes'];

    public function job() {
        return $this->belongsTo(Job::class, 'trabalho_id');
    }
}
