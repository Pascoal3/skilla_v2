<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Perfil extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'perfis';
    
    // UUID ao invés de auto-increment
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    protected $fillable = [
        'primeiro_nome',
        'sobrenome',
        'email',
        'password',
        'funcao',
        'provincia_id',
        'localizacao',
        'url_avatar',
        'bio',
        'telefone',
        'saldo_creditos',
        'esta_destacado',
        'destaque_expira_em',
        'avaliacao_media',
        'total_avaliacoes',
        'total_trabalhos_concluidos',
        'esta_ativo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'esta_destacado' => 'boolean',
        'esta_ativo' => 'boolean',
    ];
}