# Padrões de Código — Skilla

**Status:** Draft
**Owner:** TODO(USER)
**Last updated:** 2026-09-26

---

## 1. PHP / Laravel (PSR-12 + Laravel Pint)

### Configuração Pint (`pint.json`)
```json
{
  "preset": "laravel",
  "rules": {
    "php_unit_test_case_static_method_calls": true,
    "php_unit_method_casing": {"case": "camel_case"},
    "ordered_imports": {"sort_algorithm": "alpha"},
    "no_unused_imports": true,
    "trailing_comma_in_multiline": {"elements": ["arrays"]}
  }
}
```
**Comando:** `./vendor/bin/pint --test` (CI) | `./vendor/bin/pint` (fix local)

### Convenções Gerais
- **Indentação:** 4 espaços (não tabs)
- **Linhas:** máx 120 chars
- **Chaves:** `Allman` para classes/methods; `K&R` para control structures
- **Tipagem:** `declare(strict_types=1)` em todos arquivos PHP
- **Imports:** `use` agrupados: PHP built-in → vendor → app (alfabético dentro de cada grupo)
- **Nomes:** `PascalCase` (classes, interfaces, enums), `camelCase` (métodos, propriedades, variáveis), `SCREAMING_SNAKE_CASE` (constantes)
- **Interfaces:** sufixo `Interface` (ex.: `PaymentGatewayInterface`)
- **Traits:** sufixo `Trait` (ex.: `HasUuid`)

---

## 2. Models (Eloquent)

### Estrutura Padrão
```php
<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasUuid;

    protected $table = 'trabalhos';
    
    protected $fillable = [
        'cliente_id', 'categoria_id', 'titulo', 'descricao',
        'orcamento_fixo', 'tipo_trabalho', 'status', 'expira_em',
        // ...
    ];

    protected $casts = [
        'orcamento_fixo' => 'decimal:2',
        'taxa_hora_min' => 'decimal:2',
        'expira_em' => 'date',
        'esta_destacado' => 'boolean',
    ];

    // Scopes primeiro
    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'aberto')
                     ->where('proposals_open', true);
    }

    // Relacionamentos
    public function client(): BelongsTo
    {
        return $this->belongsTo(Perfil::class, 'cliente_id');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'trabalho_habilidades');
    }

    // Accessors/Mutators por último
    public function getFormattedBudgetAttribute(): string
    {
        return formatKz($this->orcamento_fixo);
    }
}
```

### Regras
- `$table` explícito (snake_case plural PT: `trabalhos`, `propostas`, `contratos`)
- `$fillable` **sempre** declarado (mass assignment protection)
- `$casts` para: `decimal:2` (dinheiro), `date`/`datetime`, `boolean`, `array`, `json`
- Scopes para queries reutilizáveis (`scopeOpen`, `scopeActive`, `scopeByCategory`)
- Relacionamentos tipados com return type (`BelongsTo`, `HasMany`, `BelongsToMany`)
- **Nunca** lógica de negócio no Model (use Services)
- UUIDs via `HasUuid` trait (v4, ordered para performance)

---

## 3. Controllers (Thin Controllers)

### Estrutura
```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPublishRequest;
use App\Services\JobService;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    public function __construct(
        protected JobService $jobService
    ) {}

    public function publish(JobPublishRequest $request, string $id): JsonResponse
    {
        $job = $this->jobService->publishJob($id, $request->validated());
        return response()->json($job);
    }
}
```

### Regras
- **Injeção de dependência** via construtor (Services, Repositories)
- **FormRequest** para validação + autorização (`authorize()`)
- **Nunca** lógica de negócio no Controller (delega para Service)
- Retorno: `JsonResponse` (API) ou `View` (Web) — consistente por rota
- HTTP status codes corretos: 200, 201, 422, 403, 404, 500
- `try/catch` apenas para converter exceptions de domínio em response HTTP

---

## 4. Services (Domain Logic)

### Estrutura
```php
<?php

namespace App\Services;

use App\Models\Job;
use App\Models\Perfil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class JobService
{
    public function publishJob(string $jobId, array $data): Job
    {
        return DB::transaction(function () use ($jobId, $data) {
            $job = Job::findOrFail($jobId);
            
            $validator = Validator::make(array_merge($job->toArray(), $data), [
                'titulo' => 'required|string|min:5',
                'categoria_id' => 'required|exists:categorias,id',
                'descricao' => 'required|string|min:20',
                'tipo_trabalho' => 'required|in:preco_fixo,por_hora',
            ]);
            
            if ($validator->fails()) {
                throw new Exception("Erro ao publicar: {$validator->errors()->first()}");
            }
            
            $job->update([
                'status' => 'aberto',
                'expira_em' => now()->addDays(30),
                ...$data,
            ]);
            
            return $job->fresh();
        });
    }
}
```

### Regras
- **Uma responsabilidade por Service** (JobService, ProposalService, EscrowService, WalletService)
- **Transações DB** (`DB::transaction`) para operações atômicas multi-tabela
- **Locking pessimista** (`lockForUpdate`) em recursos financeiros (carteiras, escrow)
- Exceptions de domínio tipadas (ex.: `InsufficientBalanceException`, `JobNotOpenException`)
- **Nunca** acessa `request()` ou `auth()` diretamente (recebe dados via parâmetros)
- Retorna Models/DTOs — não Responses HTTP
- Métodos pequenos (< 30 linhas); extrai para private methods se necessário

---

## 5. FormRequests (Validation + Authorization)

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobPublishRequest extends FormRequest
{
    public function authorize(): bool
    {
        $job = $this->route('job');
        return $job->cliente_id === $this->user()->id 
            && $job->status === 'rascunho';
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'min:5', 'max:255'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'descricao' => ['required', 'string', 'min:20'],
            'tipo_trabalho' => ['required', Rule::in(['preco_fixo', 'por_hora'])],
            'orcamento_fixo' => ['required_if:tipo_trabalho,preco_fixo', 'numeric', 'min:1'],
            'taxa_hora_min' => ['required_if:tipo_trabalho,por_hora', 'numeric', 'min:1'],
            'taxa_hora_max' => ['required_if:tipo_trabalho,por_hora', 'numeric', 'gte:taxa_hora_min'],
            'skills' => ['sometimes', 'array'],
            'skills.*' => ['exists:habilidades,id'],
            'anexos' => ['sometimes', 'array', 'max:5'],
            'anexos.*' => ['file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,webp'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título é obrigatório.',
            'descricao.min' => 'A descrição deve ter pelo menos 20 caracteres.',
            // ...
        ];
    }
}
```

### Regras
- `authorize()` verifica permissão (owner, role, status)
- `rules()` declarativas; usa `Rule::in`, `Rule::exists`, `required_if`
- `messages()` em pt-AO, claras e acionáveis
- `prepareForValidation()` para normalização (trim, upper, slug)

---

## 6. Policies (Authorization)

```php
<?php

namespace App\Policies;

use App\Models\Perfil;
use App\Models\Contract;

class ContractPolicy
{
    public function submitWork(Perfil $user, Contract $contract): bool
    {
        return $user->id === $contract->freelancer_id
            && $contract->status_contrato === 'ativo'
            && $contract->status_pagamento === 'retido';
    }

    public function approveWork(Perfil $user, Contract $contract): bool
    {
        return $user->id === $contract->cliente_id
            && $contract->status_pagamento === 'retido'
            && $contract->trabalho_entregue_em !== null
            && $contract->status_contrato === 'ativo';
    }

    public function openDispute(Perfil $user, Contract $contract): bool
    {
        return ($user->id === $contract->cliente_id || $user->id === $contract->freelancer_id)
            && $contract->status_contrato === 'ativo'
            && $contract->status_pagamento === 'retido';
    }
}
```

### Regras
- Registrar em `AuthServiceProvider::$policies`
- Usar no Controller: `$this->authorize('approveWork', $contract)` ou Policy auto-discovery
- Testar cada policy com Pest (`tests/Unit/Policies/ContractPolicyTest.php`)

---

## 7. Migrations

### Convenções
- Nome: `YYYY_MM_DD_HHMMSS_action_table.php` (ex.: `2026_06_04_01_create_transacoes_credito.php`)
- **Sempre** `down()` reversível
- FKs explícitas: `foreignUuid('coluna')->constrained('tabela')->onDelete('cascade|set null|restrict')`
- Índices compostos declarados: `$table->index(['status', 'created_at'])`
- `decimal(15,2)` para **todo** valor monetário (Kz)
- `uuid` para PKs (via `$table->uuid('id')->primary()`)
- `timestamps()` cria `created_at` + `updated_at` (não duplicar)
- Seeders de referência (províncias, categorias, skills, carteira plataforma) em `DatabaseSeeder`

---

## 8. Events & Listeners (Domain Events)

```php
// Event
class ProposalAccepted
{
    public function __construct(
        public readonly Contract $contract,
        public readonly Proposal $proposal
    ) {}
}

// Listener
class SendProposalAcceptedNotification
{
    public function handle(ProposalAccepted $event): void
    {
        $freelancer = $event->proposal->freelancer;
        $freelancer->notify(new ProposalAcceptedNotification($event->contract));
        
        // Broadcast para WebSocket
        broadcast(new ProposalAcceptedBroadcast($event->contract))->toOthers();
    }
}
```

### Regras
- Event = DTO imutável (readonly properties)
- Listener = side-effect único (notificação, email, log, webhook)
- Dispatch: `ProposalAccepted::dispatch($contract, $proposal)` (sync) ou `->dispatchAfterResponse()` (async)
- Queue para listeners pesados: `ShouldQueue` + `queue: notifications`

---

## 9. Database Queries (Performance)

### Boas Práticas
- **Eager loading:** `Job::with(['client', 'skills', 'category'])->get()` — evita N+1
- **Scopes:** `Job::open()->withClient()->latest()->paginate(15)`
- **Select columns:** `Perfil::select('id', 'nome_usuario', 'url_avatar', 'avaliacao_media')`
- **Chunk/_cursor_ para grandes volumes:** `Job::chunkById(100, fn($jobs) => ...)`
- **Subqueries para contadores:** `withCount('proposals')` em vez de `->proposals->count()`
- **Índices:** sempre em FKs, colunas de filtro (`status`, `created_at`), compostos frequentes

---

## 10. Testes (Pest)

### Estrutura
```
tests/
├── Unit/
│   ├── Models/
│   ├── Services/
│   └── Policies/
├── Feature/
│   ├── Auth/
│   ├── Jobs/
│   ├── Proposals/
│   ├── Contracts/
│   ├── Wallet/
│   └── Chat/
└── Browser/ (Dusk - opcional)
```

### Exemplo Feature Test
```php
test('cliente pode publicar job e freelancer propor', function () {
    $cliente = Perfil::factory()->cliente()->create(['saldo_creditos' => 0]);
    $freelancer = Perfil::factory()->freelancer()->create(['saldo_creditos' => 5]);
    
    // Cliente publica job
    $job = Job::factory()->for($cliente)->rascunho()->create();
    $this->actingAs($cliente)
         ->postJson("/api/jobs/{$job->id}/publish", ['titulo' => 'Novo Site', ...])
         ->assertOk();
    
    // Freelancer propõe
    $this->actingAs($freelancer)
         ->postJson('/api/proposals', [
             'job_id' => $job->id,
             'valor_proposto' => 50000,
             'dias_entrega' => 10,
             'carta_apresentacao' => 'Tenho experiência...',
         ])
         ->assertOk();
    
    // Verifica crédito debitado
    expect($freelancer->fresh()->saldo_creditos)->toBe(4);
});
```

### Cobertura Mínima
- **Unit:** Services (100% métodos públicos), Policies (100% métodos), Models (scopes, accessors)
- **Feature:** Todos UC (UC01–UC15) com pelo menos 1 teste happy path + 1 alternate
- **CI:** `php artisan test --parallel --coverage --min=70`

---

## 11. Git / Commits / Branches

### Branches
| Branch | Finalidade | Proteção |
|--------|------------|----------|
| `main` | Produção (tagged releases) | Protected: PR + CI pass + review |
| `develop` | Integração contínua | Protected: PR + CI pass |
| `feature/*` | Nova feature | Short-lived, rebase sobre `develop` |
| `fix/*` | Bug fix | Short-lived |
| `release/*` | Preparação release | Tag + changelog |
| `hotfix/*` | Correção produção | Base `main`, merge em `main` + `develop` |

### Commits (Conventional Commits)
```
<type>(<scope>): <subject>

<body>

<footer>
```

**Types:** `feat`, `fix`, `docs`, `style`, `refactor`, `perf`, `test`, `chore`, `build`, `ci`

**Exemplos:**
```
feat(job): add wizard step validation
fix(wallet): prevent negative balance under concurrency
refactor(escrow): extract release logic to service
test(proposal): add concurrent proposal submission test
chore(deps): upgrade laravel to 11.8
```

### Pull Requests
- Título: `<type>(<scope>): <subject>` (mesmo padrão commit)
- Template: Descrição, Motivação, Testes, Screenshots (UI), Checklist
- Mínimo 1 review approve + CI verde
- Squash merge (histórico limpo)

---

## 12. Exceptions & Error Handling

### Hierarquia
```
App\Exceptions\
├── DomainException (base)
│   ├── InsufficientBalanceException
│   ├── JobNotOpenException
│   ├── ProposalAlreadyExistsException
│   ├── InvalidContractStateException
│   └── UnauthorizedActionException
└── Handler.php (renderização)
```

### Handler
```php
// app/Exceptions/Handler.php
public function register(): void
{
    $this->renderable(function (DomainException $e, Request $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], $e->getCode() ?: 422);
        }
    });
}
```

---

## Related docs
- [TRD.md](TRD.md)
- [architeture-document.md](architeture-document.md)
- [tech-stack.md](tech-stack.md)
- [dev-plan.md](dev-plan.md)
- [security-guidelines.md](security-guidelines.md)
- [../01-product/functional-requirements.md](../01-product/functional-requirements.md)