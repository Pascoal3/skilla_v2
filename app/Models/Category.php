<?php

namespace App\Models;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasUuid;
    protected $table = 'categorias';
    protected $fillable = ['nome', 'slug', 'url_icone'];
}
