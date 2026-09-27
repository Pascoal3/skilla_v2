# 🏦 PLANO DE IMPLEMENTAÇÃO — BANCO SKILLA

Baseado na tua modelagem de dados, aqui está o plano completo para implementar o sistema financeiro com Escrow.

---

## 1. 📊 MAPEAMENTO DAS TABELAS FINANCEIRAS

|Tabela|Função|Campo Chave|
|---|---|---|
|`perfis`|Saldo de Créditos (propostas/boosts)|`saldo_creditos`|
|`carteiras`|Saldo KZS (dinheiro real)|`saldo`|
|`transacoes_carteiras`|Histórico geral de movimentações|`tipo`, `status`|
|`transacoes_escrow`|Dinheiro retido em contratos|`status_pagamento`|
|`contratos`|Status do pagamento do contrato|`status_pagamento`|

---

## 2. 🗂️ MODELS (Laravel)

### `Perfil.php`

PHP

```
class Perfil extends Model {
    protected $keyType = 'string';
    public $incrementing = false;

    public function carteira() {
        return $this->hasOne(Carteira::class, 'usuario_id');
    }

    public function trabalhos() {
        return $this->hasMany(Trabalho::class, 'cliente_id');
    }

    public function propostas() {
        return $this->hasMany(Proposta::class, 'freelancer_id');
    }

    public function contratosCliente() {
        return $this->hasMany(Contrato::class, 'cliente_id');
    }

    public function contratosFreelancer() {
        return $this->hasMany(Contrato::class, 'freelancer_id');
    }
}
```

### `Carteira.php`

PHP

```
class Carteira extends Model {
    protected $keyType = 'string';
    public $incrementing = false;
    protected $casts = ['saldo' => 'decimal:2'];

    public function usuario() {
        return $this->belongsTo(Perfil::class, 'usuario_id');
    }

    public function transacoesOrigem() {
        return $this->hasMany(TransacaoCarteira::class, 'carteira_origem_id');
    }

    public function transacoesDestino() {
        return $this->hasMany(TransacaoCarteira::class, 'carteira_destino_id');
    }

    public function escrowsOrigem() {
        return $this->hasMany(TransacaoEscrow::class, 'carteira_origem_id');
    }

    public function escrowsDestino() {
        return $this->hasMany(TransacaoEscrow::class, 'carteira_destino_id');
    }
}
```

### `TransacaoEscrow.php`

PHP

```
class TransacaoEscrow extends Model {
    protected $keyType = 'string';
    public $incrementing = false;
    protected $casts = [
        'valor' => 'decimal:2',
        'valor_comissao' => 'decimal:2',
        'valor_liquido_freelancer' => 'decimal:2',
        'retido_em' => 'datetime',
        'liberado_em' => 'datetime'
    ];

    public function contrato() {
        return $this->belongsTo(Contrato::class);
    }

    public function carteiraOrigem() {
        return $this->belongsTo(Carteira::class, 'carteira_origem_id');
    }

    public function carteiraDestino() {
        return $this->belongsTo(Carteira::class, 'carteira_destino_id');
    }
}
```

### `Contrato.php`

PHP

```
class Contrato extends Model {
    protected $keyType = 'string';
    public $incrementing = false;
    protected $casts = [
        'valor_acordado' => 'decimal:2',
        'comissao_plataforma' => 'decimal:2',
        'valor_freelancer' => 'decimal:2',
        'data_limite' => 'date',
        'trabalho_entregue_em' => 'datetime',
        'aprovado_em' => 'datetime'
    ];

    public function trabalho() {
        return $this->belongsTo(Trabalho::class);
    }

    public function proposta() {
        return $this->belongsTo(Proposta::class);
    }

    public function cliente() {
        return $this->belongsTo(Perfil::class, 'cliente_id');
    }

    public function freelancer() {
        return $this->belongsTo(Perfil::class, 'freelancer_id');
    }

    public function escrow() {
        return $this->hasOne(TransacaoEscrow::class, 'contrato_id');
    }

    public function disputa() {
        return $this->hasOne(Disputa::class, 'contrato_id');
    }

    public function conversa() {
        return $this->hasOne(Conversa::class, 'contrato_id');
    }
}
```

---

## 3. 💼 WALLET SERVICE (O Coração do Sistema)

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

    /**
     * Garante que o usuário tenha uma carteira KZS
     */
    public function getOrCreateWallet(Perfil $user): Carteira {
        return Carteira::firstOrCreate(
            ['usuario_id' => $user->id],
            [
                'saldo' => 0,
                'tipo' => 'usuario',
                'moeda' => 'AOA'
            ]
        );
    }

    /**
     * Recarga de saldo (Simulação Multicaixa)
     */
    public function deposit(Perfil $user, float $amount): Carteira {
        return DB::transaction(function () use ($user, $amount) {
            $wallet = $this->getOrCreateWallet($user);
            $wallet->increment('saldo', $amount);

            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => null, // null = recarga externa
                'carteira_destino_id' => $wallet->id,
                'valor' => $amount,
                'tipo' => 'recarga',
                'metodo_pagamento' => 'multicaixa_express',
                'descricao' => 'Recarga de saldo via Multicaixa Express',
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
            $wallet = $this->getOrCreateWallet($user);

            if ($wallet->saldo < $amount) {
                throw new \Exception('Saldo insuficiente na carteira');
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

            // 1. Retirar dinheiro do cliente
            $this->withdraw($cliente, $valorAcordado, 'debito_escrow', $contrato->id);

            // 2. Criar registo no Escrow (dinheiro retido)
            $escrow = TransacaoEscrow::create([
                'id' => Str::uuid(),
                'contrato_id' => $contrato->id,
                'carteira_origem_id' => $this->getOrCreateWallet($cliente)->id,
                'carteira_destino_id' => $this->getOrCreateWallet($freelancer)->id,
                'valor' => $valorAcordado,
                'valor_comissao' => $comissao,
                'valor_liquido_freelancer' => $liquidoFreelancer,
                'status_pagamento' => 'retido',
                'metodo_liberacao' => null,
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
            $adminWallet = $this->getAdminWallet(); // Carteira da plataforma

            // 1. Creditar Freelancer (valor líquido)
            $freelancerWallet = $this->getOrCreateWallet($freelancer);
            $freelancerWallet->increment('saldo', $escrow->valor_liquido_freelancer);

            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => null, // Vem do escrow
                'carteira_destino_id' => $freelancerWallet->id,
                'valor' => $escrow->valor_liquido_freelancer,
                'tipo' => 'credito_escrow',
                'metodo_pagamento' => 'interno',
                'id_referencia' => $contrato->id,
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

            // 5. Atualizar métricas do freelancer
            $freelancer->increment('total_trabalhos_concluidos');
            $this->recalcularAvaliacaoMedia($freelancer);

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

            // 1. Devolver dinheiro ao cliente
            $clienteWallet = $this->getOrCreateWallet($cliente);
            $clienteWallet->increment('saldo', $escrow->valor);

            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => null,
                'carteira_destino_id' => $clienteWallet->id,
                'valor' => $escrow->valor,
                'tipo' => 'reembolso_escrow',
                'metodo_pagamento' => 'interno',
                'id_referencia' => $contrato->id,
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
     * GASTAR CRÉDITOS - Enviar proposta ou Boost
     */
    public function spendCredits(Perfil $freelancer, int $amount, string $descricao): void {
        DB::transaction(function () use ($freelancer, $amount, $descricao) {
            if ($freelancer->saldo_creditos < $amount) {
                throw new \Exception('Créditos insuficientes');
            }

            $freelancer->decrement('saldo_creditos', $amount);

            // Registar na tabela de transações de carteiras para auditoria
            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => null,
                'carteira_destino_id' => null,
                'valor' => $amount,
                'tipo' => 'debito_credito',
                'metodo_pagamento' => 'creditos',
                'descricao' => $descricao,
                'status' => 'concluido'
            ]);
        });
    }

    /**
     * OBTER CARTEIRA DO ADMIN (Para comissões)
     */
    private function getAdminWallet(): Carteira {
        $admin = Perfil::where('funcao', 'admin')->first();
        return $this->getOrCreateWallet($admin);
    }

    /**
     * RECALCULAR AVALIAÇÃO MÉDIA
     */
    private function recalcularAvaliacaoMedia(Perfil $freelancer): void {
        $media = $freelancer->avaliacoesComoAvaliado()->avg('nota') ?? 0;
        $total = $freelancer->avaliacoesComoAvaliado()->count();
        
        $freelancer->update([
            'avaliacao_media' => round($media, 2),
            'total_avaliacoes' => $total
        ]);
    }

    private function getDescricaoTipo(string $tipo): string {
        $descricoes = [
            'debito_escrow' => 'Retenção de fundos (Escrow)',
            'credito_escrow' => 'Recebimento de contrato concluído',
            'reembolso_escrow' => 'Reembolso de contrato cancelado',
            'saque' => 'Saque para conta bancária',
            'comissao' => 'Comissão da plataforma'
        ];
        return $descricoes[$tipo] ?? $tipo;
    }
}
```

---

## 4. 🎮 CONTROLLERS

### `RecargaController.php`

PHP

```
class RecargaController extends Controller {
    public function store(Request $request, WalletService $walletService) {
        $request->validate([
            'valor' => 'required|numeric|min:1000' // Mínimo 1.000 KZS
        ]);

        try {
            $wallet = $walletService->deposit(auth()->user()->perfil, $request->valor);
            
            return response()->json([
                'success' => true,
                'message' => 'Recarga realizada com sucesso',
                'novo_saldo' => $wallet->saldo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
```

### `ContratoController.php`

PHP

```
class ContratoController extends Controller {

    public function acceptProposal(Proposta $proposta, WalletService $walletService) {
        $cliente = auth()->user()->perfil;
        $trabalho = $proposta->trabalho;

        // Validar se cliente é dono do trabalho
        if ($trabalho->cliente_id !== $cliente->id) {
            abort(403);
        }

        DB::transaction(function () use ($proposta, $trabalho, $walletService) {
            // 1. Criar Contrato
            $valorAcordado = $proposta->valor_proposto;
            $comissao = $valorAcordado * 0.10; // 10%
            $liquidoFreelancer = $valorAcordado - $comissao;

            $contrato = Contrato::create([
                'id' => Str::uuid(),
                'trabalho_id' => $trabalho->id,
                'proposta_id' => $proposta->id,
                'cliente_id' => $trabalho->cliente_id,
                'freelancer_id' => $proposta->freelancer_id,
                'status_contrato' => 'ativo',
                'valor_acordado' => $valorAcordado,
                'comissao_plataforma' => $comissao,
                'valor_freelancer' => $liquidoFreelancer,
                'dias_entrega' => $proposta->dias_entrega,
                'data_limite' => now()->addDays($proposta->dias_entrega),
                'status_pagamento' => 'pendente'
            ]);

            // 2. Atualizar Proposta
            $proposta->update(['status' => 'aceita']);

            // 3. Atualizar Trabalho
            $trabalho->update([
                'status' => 'em_andamento',
                'proposta_aceita_id' => $proposta->id
            ]);

            // 4. Iniciar Escrow
            $walletService->initEscrow($contrato);

            // 5. Criar Conversa
            Conversa::create([
                'id' => Str::uuid(),
                'contrato_id' => $contrato->id,
                'cliente_id' => $contrato->cliente_id,
                'freelancer_id' => $contrato->freelancer_id,
                'ultima_mensagem_em' => now()
            ]);
        });

        return response()->json(['success' => true, 'message' => 'Contrato criado e fundos retidos']);
    }

    public function approveWork(Contrato $contrato, WalletService $walletService) {
        $cliente = auth()->user()->perfil;

        if ($contrato->cliente_id !== $cliente->id) {
            abort(403);
        }

        if ($contrato->status_pagamento !== 'retido') {
            return response()->json(['error' => 'Pagamento já foi processado'], 400);
        }

        try {
            $walletService->releaseEscrow($contrato);
            
            return response()->json(['success' => true, 'message' => 'Trabalho aprovado e pagamento liberado']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
```

### `PropostaController.php`

PHP

```
class PropostaController extends Controller {

    public function store(Request $request, Trabalho $trabalho, WalletService $walletService) {
        $freelancer = auth()->user()->perfil;
        $custoProposta = 100; // 100 créditos por proposta

        $request->validate([
            'carta_apresentacao' => 'required|string|max:2000',
            'valor_proposto' => 'required|numeric|min:1000',
            'dias_entrega' => 'required|integer|min:1'
        ]);

        DB::transaction(function () use ($request, $trabalho, $freelancer, $walletService, $custoProposta) {
            // 1. Gastar créditos
            $walletService->spendCredits(
                $freelancer, 
                $custoProposta, 
                'Envio de proposta - Trabalho #' . substr($trabalho->id, 0, 8)
            );

            // 2. Criar Proposta
            Proposta::create([
                'id' => Str::uuid(),
                'trabalho_id' => $trabalho->id,
                'freelancer_id' => $freelancer->id,
                'carta_apresentacao' => $request->carta_apresentacao,
                'valor_proposto' => $request->valor_proposto,
                'dias_entrega' => $request->dias_entrega,
                'status' => 'pendente',
                'creditos_gastos' => $custoProposta
            ]);
        });

        return response()->json(['success' => true, 'message' => 'Proposta enviada com sucesso']);
    }
}
```

---

## 5. 📈 DASHBOARD FINANCEIRO

### `DashboardController.php`

PHP

```
class DashboardController extends Controller {

    public function cliente(WalletService $walletService) {
        $user = auth()->user()->perfil;
        $wallet = $walletService->getOrCreateWallet($user);

        $dados = [
            'user' => [
                'name' => $user->primeiro_nome,
                'email' => $user->email
            ],
            'dashboard' => [
                'wallet_balance' => $wallet->saldo,
                'published_jobs' => $user->trabalhos()->count(),
                'received_proposals' => $user->trabalhos()->with('propostas')->get()->sum(fn($t) => $t->propostas->count()),
                'in_progress' => $user->contratosCliente()->where('status_contrato', 'ativo')->count(),
                'completed' => $user->contratosCliente()->where('status_contrato', 'concluido')->count(),
                'escrow_amount' => TransacaoEscrow::join('contratos', 'transacoes_escrow.contrato_id', '=', 'contratos.id')
                    ->where('contratos.cliente_id', $user->id)
                    ->where('transacoes_escrow.status_pagamento', 'retido')
                    ->sum('valor')
            ],
            'active_jobs' => $user->trabalhos()
                ->where('status', 'aberto')
                ->with(['categoria', 'propostas'])
                ->limit(5)
                ->get()
        ];

        return response()->json($dados);
    }

    public function freelancer(WalletService $walletService) {
        $user = auth()->user()->perfil;
        $wallet = $walletService->getOrCreateWallet($user);

        $dados = [
            'user' => [
                'name' => $user->primeiro_nome,
                'email' => $user->email,
                'rating' => $user->avaliacao_media
            ],
            'dashboard' => [
                'wallet_balance' => $wallet->saldo,
                'credits' => $user->saldo_creditos,
                'active_jobs' => $user->contratosFreelancer()->where('status_contrato', 'ativo')->count(),
                'total_proposals' => $user->propostas()->count(),
                'pending_proposals' => $user->propostas()->where('status', 'pendente')->count(),
                'total_earned' => TransacaoCarteira::where('carteira_destino_id', $wallet->id)
                    ->where('tipo', 'credito_escrow')
                    ->sum('valor'),
                'escrow_amount' => TransacaoEscrow::join('contratos', 'transacoes_escrow.contrato_id', '=', 'contratos.id')
                    ->where('contratos.freelancer_id', $user->id)
                    ->where('transacoes_escrow.status_pagamento', 'retido')
                    ->sum('valor'),
                'completed_jobs' => $user->total_trabalhos_concluidos
            ],
            'active_job' => $user->contratosFreelancer()
                ->where('status_contrato', 'ativo')
                ->with(['trabalho', 'proposta'])
                ->first(),
            'recent_proposals' => $user->propostas()
                ->with(['trabalho', 'trabalho.cliente'])
                ->orderByDesc('criado_em')
                ->limit(5)
                ->get()
        ];

        return response()->json($dados);
    }
}
```

---

## 6. 🔒 SEGURANÇA E VALIDAÇÕES

### Middleware `CheckWalletBalance.php`

PHP

```
class CheckWalletBalance {
    public function handle($request, Closure $next, $minAmount = 0) {
        $wallet = auth()->user()->perfil->carteira;

        if (!$wallet || $wallet->saldo < $minAmount) {
            return response()->json([
                'error' => 'Saldo insuficiente',
                'saldo_atual' => $wallet?->saldo ?? 0,
                'necessario' => $minAmount
            ], 402);
        }

        return $next($request);
    }
}
```

### Validações Importantes

PHP

```
// Em qualquer transação financeira
$request->validate([
    'valor' => 'required|numeric|min:1000|max:10000000',
]);

// Usar DB::transaction() SEMPRE
DB::transaction(function () {
    // Todas as operações financeiras aqui
});

// Usar locking em alta concorrência
$wallet = Carteira::where('usuario_id', $userId)->lockForUpdate()->first();
```

---

## 7. 📊 FLUXO COMPLETO RESUMIDO

text

```
┌─────────────────────────────────────────────────────────────────┐
│                    FLUXO FINANCEIRO SKILLA                       │
└─────────────────────────────────────────────────────────────────┘

1. RECARGA
   Cliente → Multicaixa → Carteira Cliente (saldo +)
   └─ transacoes_carteiras: tipo='recarga'

2. PROPOSTA
   Freelancer → Gasta Créditos → saldo_creditos (-)
   └─ transacoes_carteiras: tipo='debito_credito'

3. CONTRATAÇÃO (ESCROW)
   Cliente → Carteira (-) → Escrow (retido)
   └─ transacoes_carteiras: tipo='debito_escrow'
   └─ transacoes_escrow: status='retido'

4. CONCLUSÃO
   Escrow → Freelancer (saldo +) + Plataforma (comissão)
   └─ transacoes_carteiras: tipo='credito_escrow' + 'comissao'
   └─ transacoes_escrow: status='liberado'

5. DISPUTA
   Escrow → Cliente (reembolso)
   └─ transacoes_carteiras: tipo='reembolso_escrow'
   └─ transacoes_escrow: status='devolvido_cliente'
```

---

## 8. 📁 ESTRUTURA DE ARQUIVOS SUGERIDA

text

```
app/
├── Models/
│   ├── Perfil.php
│   ├── Carteira.php
│   ├── TransacaoCarteira.php
│   ├── TransacaoEscrow.php
│   ├── Contrato.php
│   ├── Proposta.php
│   └── Trabalho.php
├── Services/
│   └── WalletService.php
├── Http/
│   ├── Controllers/
│   │   ├── RecargaController.php
│   │   ├── ContratoController.php
│   │   ├── PropostaController.php
│   │   └── DashboardController.php
│   └── Middleware/
│       └── CheckWalletBalance.php
└── Rules/
    └── SufficientBalance.php
```

---

## 9. ✅ CHECKLIST DE IMPLEMENTAÇÃO

- [ ]  Criar migrations das tabelas financeiras
- [ ]  Criar Models com relacionamentos
- [ ]  Implementar WalletService
- [ ]  Criar Controller de Recarga (simulada)
- [ ]  Integrar Escrow no aceite de proposta
- [ ]  Integrar liberação no approve de trabalho
- [ ]  Criar middleware de validação de saldo
- [ ]  Implementar dashboard financeiro
- [ ]  Criar seeders para testes (carteiras, admin wallet)
- [ ]  Testar fluxos de disputa e reembolso
- [ ]  Adicionar logs de auditoria


# ✅ A tua abordagem está **CORRETÍSSIMA**!

O plano que definiste está alinhado com as melhores práticas de desenvolvimento de sistemas financeiros. Separar a lógica de negócio (Services) dos Controllers é exatamente o que garante segurança e manutenibilidade.

Aqui está a minha análise detalhada, com o que está excelente e o que precisas de adicionar para tornar o sistema à prova de falhas:

---

## 🟢 O Que Está Excelente

|Ponto|Por que está correto|
|---|---|
|**Services em vez de Controllers**|Controllers devem apenas receber requests e devolver respostas. A lógica de dinheiro fica protegida nos Services.|
|**`DB::transaction`**|Garante atomicidade. Ou tudo acontece, ou nada acontece. Evita dinheiro "perdido no meio".|
|**`lockForUpdate()`**|Previne **Race Conditions**. Sem isso, um usuário poderia gastar o mesmo saldo duas vezes simultaneamente.|
|**Ordem das Migrations**|Respeita as chaves estrangeiras e a integridade referencial.|

---

## 🟡 O Que Falta Adicionar (Crítico)

### 1. Tabela de `transacoes_credito`

No teu plano mencionaste o gasto de créditos, mas na modelagem anterior tínhamos `saldo_creditos` direto na tabela `perfis`. Para auditoria completa, recomendo criar uma tabela específica para transações de créditos, igual à de dinheiro.

PHP

```
Schema::create('transacoes_creditos', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->uuid('perfil_id');
    $table->integer('quantidade'); // Positivo (compra) ou Negativo (gasto)
    $table->string('tipo'); // 'compra', 'proposta', 'boost', 'bonus'
    $table->uuid('referencia_id')->nullable(); // ID da proposta ou destaque
    $table->timestamps();
});
```

### 2. Carteira da Plataforma

Precisas de uma carteira "mestre" para receber as comissões. Cria um seed para isso:

PHP

```
// Database/Seeders/AdminWalletSeeder.php
$admin = Perfil::where('funcao', 'admin')->first();
Carteira::create([
    'usuario_id' => $admin->id,
    'saldo' => 0,
    'tipo' => 'plataforma'
]);
```

### 3. Eventos e Listeners (Opcional mas Recomendado)

Para não sobrecarregar o `PaymentService`, usa eventos para ações secundárias:

PHP

```
// Quando pagamento é liberado
Event::dispatch(new PaymentReleased($contrato));

// Listeners:
// - Enviar email de confirmação
// - Criar notificação no sistema
// - Atualizar métricas do freelancer
```

---

## 🔵 Implementação Prática do Teu Plano

Aqui está o esqueleto do `PaymentService` seguindo exatamente a tua estrutura:

PHP

```
// app/Services/PaymentService.php
namespace App\Services;

use App\Models\Carteira;
use App\Models\Contrato;
use App\Models\TransacaoCarteira;
use App\Models\TransacaoEscrow;
use App\Models\Perfil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentService {

    public function executeEscrow(Contrato $contrato) {
        return DB::transaction(function () use ($contrato) {
            // LOCK nas carteiras para evitar race condition
            $clienteWallet = Carteira::where('usuario_id', $contrato->cliente_id)
                ->lockForUpdate()
                ->first();
            
            $freelancerWallet = Carteira::where('usuario_id', $contrato->freelancer_id)
                ->lockForUpdate()
                ->first();

            if ($clienteWallet->saldo < $contrato->valor_acordado) {
                throw new \Exception('Saldo insuficiente para iniciar escrow');
            }

            // 1. Debitar cliente
            $clienteWallet->decrement('saldo', $contrato->valor_acordado);

            // 2. Registrar transação
            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => $clienteWallet->id,
                'carteira_destino_id' => null, // Em escrow
                'valor' => $contrato->valor_acordado,
                'tipo' => 'debito_escrow',
                'id_referencia' => $contrato->id,
                'status' => 'concluido'
            ]);

            // 3. Criar registro no Escrow
            $escrow = TransacaoEscrow::create([
                'id' => Str::uuid(),
                'contrato_id' => $contrato->id,
                'carteira_origem_id' => $clienteWallet->id,
                'carteira_destino_id' => $freelancerWallet->id,
                'valor' => $contrato->valor_acordado,
                'valor_comissao' => $contrato->comissao_plataforma,
                'valor_liquido_freelancer' => $contrato->valor_freelancer,
                'status_pagamento' => 'retido',
                'retido_em' => now()
            ]);

            // 4. Atualizar contrato
            $contrato->update(['status_pagamento' => 'retido']);

            return $escrow;
        });
    }

    public function releasePayment(Contrato $contrato) {
        return DB::transaction(function () use ($contrato) {
            $escrow = $contrato->escrow;
            
            if ($escrow->status_pagamento !== 'retido') {
                throw new \Exception('Escrow não está retido');
            }

            $freelancerWallet = Carteira::where('usuario_id', $contrato->freelancer_id)
                ->lockForUpdate()
                ->first();
            
            $adminWallet = Carteira::where('tipo', 'plataforma')
                ->lockForUpdate()
                ->first();

            // 1. Creditar Freelancer
            $freelancerWallet->increment('saldo', $escrow->valor_liquido_freelancer);
            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => null,
                'carteira_destino_id' => $freelancerWallet->id,
                'valor' => $escrow->valor_liquido_freelancer,
                'tipo' => 'credito_escrow',
                'id_referencia' => $contrato->id,
                'status' => 'concluido'
            ]);

            // 2. Creditar Plataforma
            $adminWallet->increment('saldo', $escrow->valor_comissao);
            TransacaoCarteira::create([
                'id' => Str::uuid(),
                'carteira_origem_id' => null,
                'carteira_destino_id' => $adminWallet->id,
                'valor' => $escrow->valor_comissao,
                'tipo' => 'comissao',
                'id_referencia' => $contrato->id,
                'status' => 'concluido'
            ]);

            // 3. Atualizar Escrow e Contrato
            $escrow->update([
                'status_pagamento' => 'liberado',
                'liberado_em' => now()
            ]);
            
            $contrato->update([
                'status_pagamento' => 'liberado',
                'status_contrato' => 'concluido',
                'aprovado_em' => now()
            ]);

            return $escrow;
        });
    }
}
```

---

## 🔴 Armadilhas Comuns (Cuidado!)

|Problema|Solução|
|---|---|
|**Decimal Precision**|Usa sempre `decimal(15,2)` no banco e `bcmultiply()` no PHP se necessário.|
|**Saldo Negativo**|Valida **antes** de debitar. Nunca confies no front-end.|
|**Timeout no Transaction**|Se a transação for muito longa, o MySQL pode dar rollback. Mantém a lógica simples.|
|**Concorrência**|O `lockForUpdate()` é obrigatório em qualquer leitura de saldo antes de escrever.|
|**Logs de Auditoria**|Nunca deletes registros das tabelas de transação. Usa `soft deletes` se necessário.|

---

## 📁 Estrutura Final Sugerida

text

```
app/
├── Models/
│   ├── Carteira.php
│   ├── TransacaoCarteira.php
│   ├── TransacaoEscrow.php
│   ├── TransacaoCredito.php (Nova)
│   └── Contrato.php
├── Services/
│   └── PaymentService.php
├── Http/
│   ├── Controllers/
│   │   ├── RecargaController.php
│   │   ├── ProposalController.php (Créditos)
│   │   └── ContractController.php (Escrow)
│   └── Middleware/
│       └── CheckWalletBalance.php
├── Events/
│   ├── PaymentReleased.php
│   └── EscrowCreated.php
└── Listeners/
    ├── SendPaymentEmail.php
    └── UpdateFreelancerMetrics.php
```

---

## ✅ Veredito

**O teu plano está 95% perfeito.** Só precisas de:

1. Adicionar a tabela de transações de créditos para auditoria completa.
2. Garantir que a carteira da plataforma existe antes de lançar comissões.
3. Implementar o `lockForUpdate()` em **todas** as leituras de saldo.

Podes avançar com confiança. Esta arquitetura é escalável e segura o suficiente para lidar com dinheiro real no futuro. 🚀