<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use App\Models\Perfil;

class Wallet extends Model
{
    use HasUuid;

    protected $table = 'carteiras';

    protected $fillable = [
        'usuario_id',
        'saldo',
        'tipo',
        'moeda'
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'usuario_id');
    }
}

