<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'primeiro_nome',
        'sobrenome',
        'email',
        'password',
        'provincia_id',
        'funcao',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}