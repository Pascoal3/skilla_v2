<?php

namespace App\Models;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model {
    use HasUuid;
    protected $table = 'habilidades';
    protected $fillable = ['nome', 'categoria'];
}
