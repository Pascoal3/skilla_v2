<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model {
    use HasUuid;
    protected $table = 'carteiras';
    protected $fillable = ['usuario_id', 'saldo', 'tipo', 'moeda'];

    public function profile() {
        return $this->belongsTo(Profile::class, 'usuario_id');
    }
}
