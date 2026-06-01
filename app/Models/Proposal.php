<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model {
    use HasUuid;
    protected $table = 'propostas';
    protected $fillable = ['trabalho_id', 'freelancer_id', 'carta_apresentacao', 'valor_proposto', 'dias_entrega', 'status', 'creditos_gastos'];

    public function job() {
        return $this->belongsTo(Job::class, 'trabalho_id');
    }

    public function freelancer() {
        return $this->belongsTo(Profile::class, 'freelancer_id');
    }
}
