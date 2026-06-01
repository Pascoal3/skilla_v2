<?php

namespace App\Models;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model {
    use HasUuid;
    protected $table = 'destaques';
    protected $fillable = ['freelancer_id', 'status', 'creditos_gastos', 'inicio_em', 'expira_em'];
}
