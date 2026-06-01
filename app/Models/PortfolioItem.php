<?php

namespace App\Models;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model {
    use HasUuid;
    protected $table = 'itens_portfolio';
    protected $fillable = ['freelancer_id', 'titulo', 'descricao', 'url_imagem', 'url_projeto', 'categoria_id'];

    public function category() {
        return $this->belongsTo(Category::class, 'categoria_id');
    }
}
