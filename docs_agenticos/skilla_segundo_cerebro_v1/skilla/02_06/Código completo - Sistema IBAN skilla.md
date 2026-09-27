# 🏦 Código Completo — Sistema IBAN Skilla

Aqui está toda a implementação pronta para usar no teu projeto Laravel:

---

## 1. 📄 Migration Atualizada

PHP

```
// database/migrations/2024_01_01_000000_add_iban_to_carteiras_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('carteiras', function (Blueprint $table) {
            // IBAN Virtual (21 caracteres padrão angolano)
            $table->string('iban_virtual', 21)->unique()->nullable()->after('usuario_id');
            
            // Número de conta interno (para gerar o IBAN sequencial)
            $table->unsignedBigInteger('numero_conta_interno')->unique()->nullable()->after('iban_virtual');
            
            // IBAN Externo (para saques - o usuário cadastra o IBAN real dele)
            $table->string('iban_externo', 21)->nullable()->after('numero_conta_interno');
            
            // Banco do IBAN externo (ex: BAI, BFA, BIC)
            $table->string('banco_externo', 50)->nullable()->after('iban_externo');
            
            // Titular do IBAN externo (deve coincidir com o nome do perfil)
            $table->string('titular_externo', 100)->nullable()->after('banco_externo');
            
            // Índice para buscas rápidas
            $table->index('iban_virtual');
        });
    }

    public function down(): void {
        Schema::table('carteiras', function (Blueprint $table) {
            $table->dropIndex(['iban_virtual']);
            $table->dropColumn(['iban_virtual', 'numero_conta_interno', 'iban_externo', 'banco_externo', 'titular_externo']);
        });
    }
};
```

---

## 2. 🔧 IbanService (Geração de IBAN)

PHP

```
// app/Services/IbanService.php

namespace App\Services;

use App\Models\Carteira;
use Illuminate\Support\Facades\DB;

class IbanService {
    
    /**
     * Componentes fixos do IBAN Angolano
     */
    private const PAIS = 'AO';
    private const DIGITO_CONTROLO = '06';
    private const CODIGO_BANCO = '0010'; // Skilla Bank (fictício)
    private const CODIGO_AGENCIA = '0000';
    
    /**
     * Gerar IBAN virtual para uma carteira
     */
    public function generate(Carteira $carteira): string {
        return DB::transaction(function () use ($carteira) {
            // Se já tem IBAN, não gera outro
            if ($carteira->iban_virtual) {
                return $carteira->iban_virtual;
            }

            // Gera número de conta sequencial único
            $numeroConta = $this->generateAccountNumber();
            
            // Monta o IBAN (21 caracteres)
            // AO06 0010 0000 0000 0000 0001
            $iban = self::PAIS . 
                    self::DIGITO_CONTROLO . 
                    self::CODIGO_BANCO . 
                    self::CODIGO_AGENCIA . 
                    $numeroConta;
            
            // Garante que tem exatamente 21 caracteres
            $iban = strtoupper(substr($iban, 0, 21));
            
            // Atualiza a carteira
            $carteira->update([
                'iban_virtual' => $iban,
                'numero_conta_interno' => ltrim($numeroConta, '0') ?: 0
            ]);
            
            return $iban;
        });
    }

    /**
     * Gera número de conta sequencial (11 dígitos)
     */
    private function generateAccountNumber(): string {
        // Busca o maior número de conta existente
        $maxConta = Carteira::max('numero_conta_interno') ?? 0;
        $novaConta = $maxConta + 1;
        
        // Formata para 11 dígitos com zeros à esquerda
        return str_pad((string) $novaConta, 11, '0', STR_PAD_LEFT);
    }

    /**
     * Formata IBAN para exibição (com espaços a cada 4 caracteres)
     */
    public function format(string $iban): string {
        // Remove espaços e caracteres especiais
        $clean = preg_replace('/[^A-Z0-9]/', '', strtoupper($iban));
        
        // Adiciona espaços a cada 4 caracteres
        return trim(chunk_split($clean, 4, ' '));
    }

    /**
     * Valida se o IBAN tem formato correto
     */
    public function validate(string $iban): bool {
        $clean = preg_replace('/[^A-Z0-9]/', '', strtoupper($iban));
        
        // IBAN angolano tem 21 caracteres
        if (strlen($clean) !== 21) {
            return false;
        }
        
        // Deve começar com AO06
        if (substr($clean, 0, 4) !== 'AO06') {
            return false;
        }
        
        // Resto deve ser numérico
        if (!ctype_digit(substr($clean, 4))) {
            return false;
        }
        
        return true;
    }

    /**
     * Busca carteira por IBAN
     */
    public function findByIban(string $iban): ?Carteira {
        $clean = preg_replace('/[^A-Z0-9]/', '', strtoupper($iban));
        return Carteira::where('iban_virtual', $clean)->first();
    }
}
```

---

## 3. 💳 Model Carteira Atualizado

PHP

```
// app/Models/Carteira.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carteira extends Model {
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'usuario_id',
        'iban_virtual',
        'numero_conta_interno',
        'iban_externo',
        'banco_externo',
        'titular_externo',
        'saldo',
        'tipo',
        'moeda',
    ];
    
    protected $casts = [
        'saldo' => 'decimal:2',
        'criado_em' => 'datetime',
        'atualizado_em' => 'datetime',
    ];

    /**
     * Accessor: IBAN formatado para exibição
     */
    public function getIbanFormatadoAttribute(): string {
        if (!$this->iban_virtual) {
            return '';
        }
        
        // Formata: AO06 0010 0000 0000 0000 0001
        $clean = preg_replace('/[^A-Z0-9]/', '', $this->iban_virtual);
        return trim(chunk_split($clean, 4, ' '));
    }

    /**
     * Accessor: IBAN limpo (sem espaços)
     */
    public function getIbanLimpoAttribute(): string {
        return preg_replace('/[^A-Z0-9]/', '', $this->iban_virtual ?? '');
    }

    /**
     * Relação com o usuário
     */
    public function usuario(): BelongsTo {
        return $this->belongsTo(Perfil::class, 'usuario_id');
    }

    /**
     * Relação com transações de origem
     */
    public function transacoesOrigem(): HasMany {
        return $this->hasMany(TransacaoCarteira::class, 'carteira_origem_id');
    }

    /**
     * Relação com transações de destino
     */
    public function transacoesDestino(): HasMany {
        return $this->hasMany(TransacaoCarteira::class, 'carteira_destino_id');
    }

    /**
     * Relação com escrows de origem
     */
    public function escrowsOrigem(): HasMany {
        return $this->hasMany(TransacaoEscrow::class, 'carteira_origem_id');
    }

    /**
     * Relação com escrows de destino
     */
    public function escrowsDestino(): HasMany {
        return $this->hasMany(TransacaoEscrow::class, 'carteira_destino_id');
    }

    /**
     * Verifica se a carteira tem IBAN gerado
     */
    public function temIban(): bool {
        return !empty($this->iban_virtual);
    }

    /**
     * Garante que a carteira tem IBAN (gera se não existir)
     */
    public function garantirIban(): string {
        if (!$this->temIban()) {
            return app(\App\Services\IbanService::class)->generate($this);
        }
        return $this->iban_virtual;
    }
}
```

---

## 4. 💼 WalletService Atualizado (com IBAN)

PHP

```
// app/Services/WalletService.php

namespace App\Services;

use App\Models\Perfil;
use App\Models\Carteira;
use App\Models\TransacaoCarteira;
use App\Models\TransacaoEscrow;
use App\Models\Contrato;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WalletService {
    
    protected IbanService $ibanService;

    public function __construct(IbanService $ibanService) {
        $this->ibanService = $ibanService;
    }

    /**
     * Garante que o usuário tenha uma carteira KZS com IBAN
     */
    public function getOrCreateWallet(Perfil $user): Carteira {
        $wallet = Carteira::firstOrCreate(
            ['usuario_id' => $user->id],
            [
                'id' => Str::uuid(),
                'saldo' => 0,
                'tipo' => 'usuario',
                'moeda' => 'AOA'
            ]
        );

        // Garante que tem IBAN gerado
        if (!$wallet->temIban()) {
            $this->ibanService->generate($wallet);
        }

        return $wallet;
    }

    /**
     * Recarga de saldo (Simulação Multicaixa)
     */
    public function deposit(Perfil $user, float $amount): Carteira {
        return DB::transaction(function () use ($user, $amount) {
            $wallet = $this->getOrCreateWallet($user);
            
            // LOCK para evitar race condition
            $wallet = Carteira::where('id', $wallet->id)
                ->lockForUpdate()
                ->first();
            
            $wallet->increment('saldo', $amount);

            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => null, // null = recarga externa
                'carteira_destino_id' => $wallet->id,
                'valor' => $amount,
                'tipo' => 'recarga',
                'metodo_pagamento' => 'multicaixa_express',
                'descricao' => 'Recarga de saldo via Multicaixa Express',
                'iban_referencia' => $wallet->iban_virtual,
                'status' => 'concluido'
            ]);

            return $wallet;
        });
    }

    /**
     * Retirar saldo da carteira
     */
    public function withdraw(Perfil $user, float $amount, string $tipo, ?string $referenciaId = null): Carteira {
        return DB::transaction(function () use ($user, $amount, $tipo, $referenciaId) {
            $wallet = Carteira::where('usuario_id', $user->id)
                ->lockForUpdate()
                ->first();

            if (!$wallet) {
                throw new \Exception('Carteira não encontrada');
            }

            if ($wallet->saldo < $amount) {
                throw new \Exception('Saldo insuficiente na carteira ' . $wallet->iban_formatado);
            }

            $wallet->decrement('saldo', $amount);

            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => $wallet->id,
                'carteira_destino_id' => null,
                'valor' => $amount,
                'tipo' => $tipo,
                'metodo_pagamento' => 'interno',
                'id_referencia' => $referenciaId,
                'iban_referencia' => $wallet->iban_virtual,
                'descricao' => $this->getDescricaoTipo($tipo),
                'status' => 'concluido'
            ]);

            return $wallet;
        });
    }

    /**
     * INICIAR ESCROW - Quando cliente aceita proposta
     */
    public function initEscrow(Contrato $contrato): TransacaoEscrow {
        return DB::transaction(function () use ($contrato) {
            $cliente = $contrato->cliente;
            $freelancer = $contrato->freelancer;
            $valorAcordado = $contrato->valor_acordado;
            $comissao = $contrato->comissao_plataforma;
            $liquidoFreelancer = $contrato->valor_freelancer;

            // LOCK nas carteiras
            $clienteWallet = Carteira::where('usuario_id', $cliente->id)
                ->lockForUpdate()
                ->first();
            
            $freelancerWallet = Carteira::where('usuario_id', $freelancer->id)
                ->lockForUpdate()
                ->first();

            if ($clienteWallet->saldo < $valorAcordado) {
                throw new \Exception('Saldo insuficiente. IBAN: ' . $clienteWallet->iban_formatado);
            }

            // 1. Retirar dinheiro do cliente
            $this->withdraw($cliente, $valorAcordado, 'debito_escrow', $contrato->id);

            // 2. Criar registo no Escrow (dinheiro retido)
            $escrow = TransacaoEscrow::create([
                'id' => Str::uuid(),
                'contrato_id' => $contrato->id,
                'carteira_origem_id' => $clienteWallet->id,
                'carteira_destino_id' => $freelancerWallet->id,
                'valor' => $valorAcordado,
                'valor_comissao' => $comissao,
                'valor_liquido_freelancer' => $liquidoFreelancer,
                'status_pagamento' => 'retido',
                'metodo_liberacao' => null,
                'iban_origem' => $clienteWallet->iban_virtual,
                'iban_destino' => $freelancerWallet->iban_virtual,
                'retido_em' => now()
            ]);

            // 3. Atualizar contrato
            $contrato->update([
                'status_pagamento' => 'retido',
                'status_contrato' => 'ativo'
            ]);

            return $escrow;
        });
    }

    /**
     * LIBERAR ESCROW - Quando cliente aprova trabalho
     */
    public function releaseEscrow(Contrato $contrato): TransacaoEscrow {
        return DB::transaction(function () use ($contrato) {
            $escrow = $contrato->escrow;

            if (!$escrow || $escrow->status_pagamento !== 'retido') {
                throw new \Exception('Escrow não pode ser liberado');
            }

            $freelancer = $contrato->freelancer;
            $adminWallet = $this->getAdminWallet();

            // LOCK nas carteiras
            $freelancerWallet = Carteira::where('usuario_id', $freelancer->id)
                ->lockForUpdate()
                ->first();
            
            $adminWallet = Carteira::where('id', $adminWallet->id)
                ->lockForUpdate()
                ->first();

            // 1. Creditar Freelancer (valor líquido)
            $freelancerWallet->increment('saldo', $escrow->valor_liquido_freelancer);

            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => null, // Vem do escrow
                'carteira_destino_id' => $freelancerWallet->id,
                'valor' => $escrow->valor_liquido_freelancer,
                'tipo' => 'credito_escrow',
                'metodo_pagamento' => 'interno',
                'id_referencia' => $contrato->id,
                'iban_referencia' => $freelancerWallet->iban_virtual,
                'descricao' => 'Pagamento liberado - Contrato #' . substr($contrato->id, 0, 8),
                'status' => 'concluido'
            ]);

            // 2. Creditar Plataforma (comissão)
            $adminWallet->increment('saldo', $escrow->valor_comissao);

            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => null,
                'carteira_destino_id' => $adminWallet->id,
                'valor' => $escrow->valor_comissao,
                'tipo' => 'comissao',
                'metodo_pagamento' => 'interno',
                'id_referencia' => $contrato->id,
                'iban_referencia' => $adminWallet->iban_virtual,
                'descricao' => 'Comissão da plataforma - Contrato #' . substr($contrato->id, 0, 8),
                'status' => 'concluido'
            ]);

            // 3. Atualizar Escrow
            $escrow->update([
                'status_pagamento' => 'liberado',
                'metodo_liberacao' => 'aprovacao_cliente',
                'liberado_em' => now()
            ]);

            // 4. Atualizar Contrato
            $contrato->update([
                'status_pagamento' => 'liberado',
                'status_contrato' => 'concluido',
                'aprovado_em' => now()
            ]);

            return $escrow;
        });
    }

    /**
     * REEMBOLSAR ESCROW - Quando há disputa a favor do cliente
     */
    public function refundEscrow(Contrato $contrato): TransacaoEscrow {
        return DB::transaction(function () use ($contrato) {
            $escrow = $contrato->escrow;

            if (!$escrow || $escrow->status_pagamento !== 'retido') {
                throw new \Exception('Escrow não pode ser reembolsado');
            }

            $cliente = $contrato->cliente;

            // LOCK na carteira
            $clienteWallet = Carteira::where('usuario_id', $cliente->id)
                ->lockForUpdate()
                ->first();

            // 1. Devolver dinheiro ao cliente
            $clienteWallet->increment('saldo', $escrow->valor);

            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => null,
                'carteira_destino_id' => $clienteWallet->id,
                'valor' => $escrow->valor,
                'tipo' => 'reembolso_escrow',
                'metodo_pagamento' => 'interno',
                'id_referencia' => $contrato->id,
                'iban_referencia' => $clienteWallet->iban_virtual,
                'descricao' => 'Reembolso por disputa - Contrato #' . substr($contrato->id, 0, 8),
                'status' => 'concluido'
            ]);

            // 2. Atualizar Escrow
            $escrow->update([
                'status_pagamento' => 'devolvido_cliente',
                'metodo_liberacao' => 'decisao_admin',
                'liberado_em' => now()
            ]);

            // 3. Atualizar Contrato
            $contrato->update([
                'status_pagamento' => 'devolvido_cliente',
                'status_contrato' => 'cancelado'
            ]);

            return $escrow;
        });
    }

    /**
     * OBTER CARTEIRA DO ADMIN (Para comissões)
     */
    private function getAdminWallet(): Carteira {
        $admin = Perfil::where('funcao', 'admin')->first();
        
        if (!$admin) {
            throw new \Exception('Usuário admin não encontrado');
        }
        
        return $this->getOrCreateWallet($admin);
    }

    private function getDescricaoTipo(string $tipo): string {
        $descricoes = [
            'debito_escrow' => 'Retenção de fundos (Escrow)',
            'credito_escrow' => 'Recebimento de contrato concluído',
            'reembolso_escrow' => 'Reembolso de contrato cancelado',
            'saque' => 'Saque para conta bancária',
            'comissao' => 'Comissão da plataforma',
            'recarga' => 'Recarga de saldo'
        ];
        return $descricoes[$tipo] ?? $tipo;
    }
}
```

---

## 5. 📄 Migration Atualizada para Transações (com IBAN)

PHP

```
// database/migrations/2024_01_01_000001_add_iban_to_transacoes_tables.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Adicionar IBAN às transações de carteira
        Schema::table('transacoes_carteiras', function (Blueprint $table) {
            $table->string('iban_referencia', 21)->nullable()->after('id_referencia');
            $table->index('iban_referencia');
        });

        // Adicionar IBAN às transações de escrow
        Schema::table('transacoes_escrow', function (Blueprint $table) {
            $table->string('iban_origem', 21)->nullable()->after('carteira_origem_id');
            $table->string('iban_destino', 21)->nullable()->after('carteira_destino_id');
            $table->index('iban_origem');
            $table->index('iban_destino');
        });
    }

    public function down(): void {
        Schema::table('transacoes_carteiras', function (Blueprint $table) {
            $table->dropIndex(['iban_referencia']);
            $table->dropColumn('iban_referencia');
        });

        Schema::table('transacoes_escrow', function (Blueprint $table) {
            $table->dropIndex(['iban_origem']);
            $table->dropIndex(['iban_destino']);
            $table->dropColumn(['iban_origem', 'iban_destino']);
        });
    }
};
```

---

## 6. 🎨 Component Blade — Carteira com IBAN

blade

```
{{-- resources/views/components/wallet-card.blade.php --}}

@props(['carteira'])

<div class="bg-surface-container-high rounded-xl p-6 shadow-lg border border-outline-variant">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h3 class="text-headline-sm font-bold text-black-pure">Carteira Skilla</h3>
            <p class="text-body-sm text-on-tertiary-container">Saldo disponível</p>
        </div>
        <span class="material-symbols-outlined text-[32px] text-primary">account_balance_wallet</span>
    </div>

    {{-- Saldo --}}
    <div class="mb-6">
        <p class="text-[32px] font-bold text-black-pure">
            {{ number_format($carteira->saldo, 2, ',', '.') }} KZS
        </p>
    </div>

    {{-- IBAN Virtual --}}
    <div class="bg-surface-container-lowest rounded-lg p-4 border border-outline mb-6">
        <div class="flex items-center gap-2 mb-2">
            <span class="material-symbols-outlined text-[18px] text-on-tertiary-container">account_balance</span>
            <p class="text-label-sm text-on-tertiary-container">IBAN Skilla</p>
        </div>
        
        <div class="flex items-center justify-between gap-2">
            <span class="font-mono text-body-md font-bold text-black-pure" id="iban-display">
                {{ $carteira->iban_formatado }}
            </span>
            
            <button onclick="copyIban('{{ $carteira->iban_limpo }}')" 
                    class="p-2 hover:bg-outline-variant rounded-md transition-colors" 
                    title="Copiar IBAN">
                <span class="material-symbols-outlined text-[20px]">content_copy</span>
            </button>
        </div>
        
        <p id="copy-feedback" class="text-xs text-green-600 mt-2 hidden flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">check</span>
            IBAN copiado!
        </p>
    </div>

    {{-- Ações --}}
    <div class="flex gap-3">
        <button onclick="openRecargaModal()" 
                class="flex-1 bg-primary text-white py-3 rounded-lg font-label-md hover:bg-primary-hover transition-colors flex items-center justify-center gap-2">
            <span class="material-symbols-outlined">add</span>
            Recarregar
        </button>
        
        <button onclick="openSaqueModal()" 
                class="flex-1 bg-surface-container-highest text-black-pure py-3 rounded-lg font-label-md hover:bg-outline-variant transition-colors flex items-center justify-center gap-2">
            <span class="material-symbols-outlined">remove</span>
            Sacar
        </button>
    </div>

    {{-- Extrato --}}
    <a href="{{ route('carteira.extrato') }}" 
       class="mt-4 text-center text-label-sm text-primary hover:underline flex items-center justify-center gap-1">
        Ver extrato completo
        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
    </a>
</div>

<script>
function copyIban(iban) {
    navigator.clipboard.writeText(iban).then(() => {
        const feedback = document.getElementById('copy-feedback');
        feedback.classList.remove('hidden');
        setTimeout(() => feedback.classList.add('hidden'), 2000);
    });
}

function openRecargaModal() {
    // Implementar modal de recarga
    console.log('Abrir modal de recarga');
}

function openSaqueModal() {
    // Implementar modal de saque
    console.log('Abrir modal de saque');
}
</script>
```

---

## 7. 🌾 Seeder — Carteira Admin

PHP

```
// database/seeders/AdminWalletSeeder.php

namespace Database\Seeders;

use App\Models\Perfil;
use App\Models\Carteira;
use App\Services\IbanService;
use Illuminate\Database\Seeder;

class AdminWalletSeeder extends Seeder {
    public function run(): void {
        $admin = Perfil::where('funcao', 'admin')->first();

        if (!$admin) {
            $this->command->error('Usuário admin não encontrado!');
            return;
        }

        $carteira = Carteira::firstOrCreate(
            ['usuario_id' => $admin->id],
            [
                'id' => \Illuminate\Support\Str::uuid(),
                'saldo' => 0,
                'tipo' => 'plataforma',
                'moeda' => 'AOA'
            ]
        );

        // Gerar IBAN para a carteira admin
        if (!$carteira->temIban()) {
            app(IbanService::class)->generate($carteira);
        }

        $this->command->info('Carteira admin criada com IBAN: ' . $carteira->iban_formatado);
    }
}
```

---

## 8. 📋 Checklist de Implementação

Bash

```
# 1. Rodar migrations
php artisan migrate

# 2. Criar admin (se não existir)
php artisan db:seed --class=AdminUserSeeder

# 3. Criar carteira admin
php artisan db:seed --class=AdminWalletSeeder

# 4. Limpar cache
php artisan config:clear
php artisan cache:clear
```

---

## ✅ Resumo Final

|Componente|Função|
|---|---|
|**IBAN Virtual**|Identificador único de 21 dígitos (AO06 0010...)|
|**IbanService**|Gera, valida e formata IBANs|
|**Carteira Model**|Accessors para IBAN formatado/limpo|
|**WalletService**|Integra IBAN em todas as transações|
|**Transações**|Guardam IBAN de origem/destino para auditoria|
|**Frontend**|Componente com botão de copiar IBAN|

Agora tens um sistema bancário completo e profissional dentro da Skilla! 🚀