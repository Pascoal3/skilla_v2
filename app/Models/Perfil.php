<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject; // ← ADICIONADO para JWT
use Illuminate\Support\Str;

class Perfil extends Authenticatable implements JWTSubject // ← ADICIONADO implements JWTSubject
{
    use HasFactory, HasUuids, Notifiable; // ← ADICIONADO Notifiable

    protected $table = 'perfis';

    protected $fillable = [
        'primeiro_nome',
        'sobrenome',
        'nome_usuario',
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
        'email_verified_at', // ← ADICIONADO (necessário para auth)
        'remember_token',    // ← ADICIONADO
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
        'avaliacao_media' => 'decimal:2',
    ];

    // ==========================================
    // MÉTODOS OBRIGATÓRIOS DO JWTSubject
    // ==========================================
    
    /**
     * Retorna o identificador único do usuário para o JWT
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }

    public function carteira(): HasOne
    {
        return $this->hasOne(Wallet::class, 'usuario_id');
    }

    public function trabalhosAtivos(): HasMany
    {
        return $this->hasMany(Trabalho::class, 'freelancer_id')
                    ->where('status', 'em_andamento');
    }

    public function propostas(): HasMany
    {
        return $this->hasMany(Proposta::class, 'freelancer_id');
    }

    public function propostasRecebidas(): HasMany
    {
        return $this->hasMany(Proposta::class, 'cliente_id')
                    ->whereHas('trabalho', function($query) {
                        $query->where('cliente_id', $this->id);
                    });
    }

    public function jobsConcluidos(): HasMany
    {
        return $this->hasMany(Trabalho::class, 'freelancer_id')
                    ->where('status', 'concluido');
    }

    public function trabalhos(): HasMany
    {
        return $this->hasMany(Trabalho::class, 'cliente_id');
    }

    public function notificacoes(): HasMany
    {
        return $this->hasMany(Notificacao::class, 'usuario_id');
    }

    // ==========================================
    // MÉTODOS UTILITÁRIOS
    // ==========================================

    public static function generateUniqueUsername(string $firstName, string $lastName): string
    {
        $baseUsername = Str::slug($firstName . ' ' . $lastName, '.');
        $username = $baseUsername;
        $counter = 1;

        while (self::where('nome_usuario', $username)->exists()) {
            $username = $baseUsername . '.' . rand(100, 999);
            if ($counter > 10) {
                $username = $baseUsername . $counter;
            }
            $counter++;
        }

        return $username;
    }

    // ==========================================
    // ATTRIBUTES / ACCESSORS
    // ==========================================

    public function getNomeCompletoAttribute(): string
    {
        return "{$this->primeiro_nome} {$this->sobrenome}";
    }

    public function getUrlAvatarAttribute(): string
    {
        return $this->attributes['url_avatar'] ?? '/img/foto_perfil_exemplar.png';
    }
}