## Fluxo Completo: Registro → Sessão → Painel Dinâmico

### 1. Controller de Registro (já deve ter algo parecido)

```php
<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulário de cliente
    public function showRegistoCliente()
    {
        return view('auth.registar_cliente');
    }

    // Mostrar formulário de freelancer
    public function showRegistoFreelancer()
    {
        return view('auth.registar_freelancer');
    }

    // Processar registo (serve para ambos)
    public function registar(Request $request)
    {
        $request->validate([
            'primeiro_nome' => 'required|string|max:255',
            'sobrenome'     => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:8',
            'provincia_id'  => 'required|string',
            'funcao'        => 'required|in:cliente,freelancer',
        ]);

        // Criar o usuário
        $user = User::create([
            'primeiro_nome' => $request->primeiro_nome,
            'sobrenome'     => $request->sobrenome,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'provincia_id'  => $request->provincia_id,
            'funcao'        => $request->funcao,
        ]);

        // FAZER LOGIN AUTOMÁTICO (aqui é a chave!)
        Auth::login($user);

        // Retornar resposta JSON para o JS
        return response()->json([
            'success' => true,
            'role'    => $user->funcao,
            'user'    => [
                'id'             => $user->id,
                'primeiro_nome'  => $user->primeiro_nome,
                'sobrenome'      => $user->sobrenome,
                'email'          => $user->email,
            ]
        ], 201);
    }

    // Terminar sessão
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
```

### 2. Controller do Painel

```php
<?php
// app/Http/Controllers/PainelController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PainelController extends Controller
{
    // Painel do Cliente
    public function painelCliente()
    {
        // Pega o usuário autenticado (já tem o ID, nome, tudo)
        $user = Auth::user();

        // Verifica se é mesmo um cliente
        if ($user->funcao !== 'cliente') {
            return redirect('/painel/freelancer');
        }

        // Passa os dados para a view
        return view('painel.cliente', compact('user'));
    }

    // Painel do Freelancer
    public function painelFreelancer()
    {
        $user = Auth::user();

        if ($user->funcao !== 'freelancer') {
            return redirect('/painel/cliente');
        }

        return view('painel.freelancer', compact('user'));
    }
}
```

### 3. Model User

```php
<?php
// app/Models/User.php

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

    // Método auxiliar para nome completo
    public function getNomeCompletoAttribute()
    {
        return $this->primeiro_nome . ' ' . $this->sobrenome;
    }
}
```

### 4. Migration (se ainda não tiver)

```php
<?php
// database/migrations/xxxx_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('primeiro_nome');
            $table->string('sobrenome');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('provincia_id');
            $table->enum('funcao', ['cliente', 'freelancer']);
            $table->string('foto_perfil')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
```

### 5. Rotas

```php
<?php
// routes/web.php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PainelController;

// Páginas de registo (públicas)
Route::get('/registar/cliente', [AuthController::class, 'showRegistoCliente'])->name('registar.cliente');
Route::get('/registar/freelancer', [AuthController::class, 'showRegistoFreelancer'])->name('registar.freelancer');
Route::post('/registar', [AuthController::class, 'registar'])->name('registar');

// Painéis (protegidos - só usuários logados)
Route::middleware('auth')->group(function () {
    Route::get('/painel/cliente', [PainelController::class, 'painelCliente'])->name('painel.cliente');
    Route::get('/painel/freelancer', [PainelController::class, 'painelFreelancer'])->name('painel.freelancer');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
```

### 6. Blade do Painel do Cliente (com dados dinâmicos)

```blade
{{-- resources/views/painel/cliente.blade.php --}}
{{-- Substitua os dados estáticos pelos dinâmicos: --}}

<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Skilla - Painel de {{ $user->primeiro_nome }}</title>
    {{-- ... (resto do head igual) ... --}}
</head>
<body class="bg-[#CCFF00] font-body-md text-on-surface flex min-h-screen">

<!-- SideNavBar -->
<aside class="hidden md:flex fixed left-0 top-0 h-full flex-col py-6 bg-[#1A1A1A] border-r border-[#1A1A1A] w-64 md:w-72 z-40">
    <div class="px-6 mb-8">
        <h1 class="text-headline-md font-headline-md font-bold text-white">Skilla</h1>
        <p class="text-body-sm font-body-sm text-gray-300">Plataforma Freelance</p>
    </div>
    <nav class="flex-1 px-4 space-y-1">
        {{-- ... links de navegação iguais ... --}}
    </nav>
    <div class="px-4 mt-auto border-t border-gray-800 pt-4 space-y-1">
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-gray-800 transition-colors" href="#">
            <span class="material-symbols-outlined text-[20px]">settings</span>
            <span class="text-label-md font-label-md">Definições</span>
        </a>
        {{-- BOTÃO DE LOGOUT --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-white hover:bg-gray-800 transition-colors w-full">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                <span class="text-label-md font-label-md">Terminar Sessão</span>
            </button>
        </form>
    </div>
</aside>

<!-- Main Content Area -->
<div class="flex-1 md:ml-64 lg:ml-72 flex flex-col min-h-screen">
    <!-- TopNavBar -->
    <header class="bg-white border-b border-border-subtle flex justify-between items-center w-full px-margin-desktop h-16 sticky top-0 z-50">
        {{-- ... search bar ... --}}
        <div class="flex items-center gap-4 ml-auto">
            <button class="text-secondary hover:bg-light-gray p-2 rounded-full transition-colors relative">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <button class="flex items-center gap-2 hover:bg-light-gray p-1 pr-3 rounded-full transition-colors">
                {{-- FOTO DE PERFIL DINÂMICA --}}
                @if($user->foto_perfil)
                    <img alt="{{ $user->primeiro_nome }}" 
                         class="w-8 h-8 rounded-full border border-border-subtle" 
                         src="{{ asset('storage/' . $user->foto_perfil) }}"/>
                @else
                    <div class="w-8 h-8 rounded-full border border-border-subtle bg-[#CCFF00] flex items-center justify-center">
                        <span class="text-sm font-bold text-black">
                            {{ strtoupper(substr($user->primeiro_nome, 0, 1)) }}{{ strtoupper(substr($user->sobrenome, 0, 1)) }}
                        </span>
                    </div>
                @endif
                {{-- NOME DINÂMICO --}}
                <span class="text-label-md font-label-md hidden sm:block">{{ $user->primeiro_nome }}</span>
                <span class="material-symbols-outlined text-[18px] hidden sm:block text-secondary">expand_more</span>
            </button>
        </div>
    </header>

    <!-- Dashboard Canvas -->
    <main class="flex-1 p-6 md:p-8 space-y-6 max-w-container-max mx-auto w-full">
        <!-- SAUDAÇÃO DINÂMICA -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-2">
            <div>
                {{-- NOME DINÂMICO --}}
                <h2 class="text-headline-lg font-headline-lg text-on-surface mb-1">
                    Olá, {{ $user->primeiro_nome }} 👋
                </h2>
                <p class="text-body-md font-body-md text-secondary">
                    Tens <span class="font-semibold text-primary">0 propostas novas</span> à espera de revisão.
                </p>
            </div>
            <button class="bg-[#1A1A1A] text-white text-label-md font-label-md px-4 py-2 rounded-lg hover:bg-black transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Publicar Trabalho
            </button>
        </div>

        <!-- Metrics Grid (Zerados para novo usuário) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-[#1E1E1E] rounded-lg">
                        <span class="material-symbols-outlined text-[#CCFF00]">work</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Trabalhos Publicados</h3>
                    <p class="text-metric-lg font-metric-lg text-on-surface">0</p>
                </div>
            </div>
            <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-[#1E1E1E] rounded-lg">
                        <span class="material-symbols-outlined text-[#CCFF00]">description</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Propostas Recebidas</h3>
                    <p class="text-metric-lg font-metric-lg text-on-surface">0</p>
                </div>
            </div>
            <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-[#1E1E1E] rounded-lg">
                        <span class="material-symbols-outlined text-[#CCFF00]">schedule</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Em Andamento</h3>
                    <p class="text-metric-lg font-metric-lg text-on-surface">0</p>
                </div>
            </div>
            <div class="bg-white border border-border-subtle rounded-[12px] p-5 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-[#1E1E1E] rounded-lg">
                        <span class="material-symbols-outlined text-[#CCFF00]">check_circle</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-label-md font-label-md text-secondary uppercase tracking-wider mb-1">Concluídos</h3>
                    <p class="text-metric-lg font-metric-lg text-on-surface">0</p>
                </div>
            </div>
        </div>

        <!-- Carteira (Zerada para novo usuário) -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <div class="lg:col-span-3 bg-white border border-border-subtle rounded-[12px] p-6 flex flex-col">
                <h3 class="text-headline-sm font-headline-sm mb-6">A Minha Carteira Skilla</h3>
                <div class="flex-1 flex flex-col justify-center">
                    <div class="mb-6">
                        <p class="text-body-sm font-body-sm text-secondary mb-1">Saldo Disponível</p>
                        <p class="text-metric-lg font-metric-lg text-[#1A1A1A]">0,00 KZS</p>
                    </div>
                    <div class="mb-8 bg-[#1A1A1A] p-4 rounded-lg">
                        <p class="text-body-sm font-body-sm text-[#CCFF00] mb-1">Em Escrow (Cativos)</p>
                        <p class="text-headline-md font-headline-md text-[#CCFF00]">0,00 KZS</p>
                    </div>
                    <div class="mt-auto">
                        <button class="w-full sm:w-auto border border-[#1A1A1A] text-[#1A1A1A] hover:bg-gray-100 text-label-md font-label-md px-6 py-2.5 rounded-lg transition-colors">
                            Recarregar Saldo
                        </button>
                    </div>
                </div>
            </div>

            <!-- Estado vazio -->
            <div class="lg:col-span-2 bg-white border border-border-subtle rounded-[12px] p-6 flex flex-col items-center justify-center">
                <span class="material-symbols-outlined text-[48px] text-gray-300 mb-4">inbox</span>
                <h3 class="text-headline-sm font-headline-sm text-gray-400 mb-2">Tudo em dia!</h3>
                <p class="text-body-sm text-gray-400 text-center">Nenhuma ação pendente no momento.</p>
            </div>
        </div>

        <!-- Jobs Ativos (Estado vazio para novo usuário) -->
        <div class="bg-white border border-border-subtle rounded-[12px] overflow-hidden">
            <div class="p-6 border-b border-border-subtle flex justify-between items-center bg-white">
                <h3 class="text-headline-sm font-headline-sm text-[#1E1E1E]">Os Meus Jobs Ativos</h3>
            </div>
            <div class="p-12 text-center">
                <span class="material-symbols-outlined text-[64px] text-gray-300 mb-4">work_off</span>
                <h4 class="text-headline-sm font-headline-sm text-gray-400 mb-2">Nenhum trabalho publicado ainda</h4>
                <p class="text-body-md text-gray-400 mb-6">Publique o seu primeiro trabalho e encontre talentos incríveis!</p>
                <button class="bg-[#1A1A1A] text-white text-label-md font-label-md px-6 py-3 rounded-lg hover:bg-black transition-colors inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Publicar Primeiro Trabalho
                </button>
            </div>
        </div>

    </main>
</div>
</body>
</html>
```

### 7. Blade do Painel do Freelancer (com dados dinâmicos)

```blade
{{-- resources/views/painel/freelancer.blade.php --}}
{{-- Apenas as partes que mudam: --}}

<title>Skilla - Dashboard de {{ $user->primeiro_nome }}</title>

{{-- Na sidebar, o perfil: --}}
<div class="flex items-center gap-3 mb-6 px-2">
    @if($user->foto_perfil)
        <img class="w-10 h-10 rounded-full border border-outline-variant" 
             src="{{ asset('storage/' . $user->foto_perfil) }}" 
             alt="{{ $user->primeiro_nome }}">
    @else
        <div class="w-10 h-10 rounded-full border border-outline-variant bg-[#CCFF00] flex items-center justify-center">
            <span class="text-sm font-bold text-black">
                {{ strtoupper(substr($user->primeiro_nome, 0, 1)) }}{{ strtoupper(substr($user->sobrenome, 0, 1)) }}
            </span>
        </div>
    @endif
    <div class="flex flex-col">
        <span class="text-white font-bold text-sm">{{ $user->primeiro_nome }} {{ $user->sobrenome }}</span>
        <span class="text-on-primary-container text-[11px]">⭐ Novo ({{ ucfirst($user->provincia_id) }})</span>
    </div>
</div>

{{-- Saudação: --}}
<h2 class="font-headline-md text-headline-md text-black-pure mb-2">
    Bom dia, {{ $user->primeiro_nome }} 👋
</h2>

{{-- Logout na sidebar: --}}
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="flex items-center gap-2 text-on-primary-container hover:text-secondary text-sm transition-colors w-full">
        <span class="material-symbols-outlined text-[18px]">logout</span> Sair
    </button>
</form>
```

## Resumo do Fluxo:

```
┌─────────────────────┐
│  Formulário Registo  │
│  (JS envia POST)     │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────┐
│  AuthController      │
│  - Cria User         │
│  - Auth::login()  ◄──── SESSÃO CRIADA AQUI
│  - Retorna JSON      │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────┐
│  JS redireciona      │
│  window.location =   │
│  /painel/cliente     │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────┐
│  PainelController    │
│  $user = Auth::user()│ ◄── PEGA O USUÁRIO LOGADO
│  return view(        │
│    'painel.cliente', │
│    compact('user')   │
│  )                   │
└──────────┬──────────┘
           │
           ▼
┌─────────────────────┐
│  Blade Template      │
│  {{ $user->nome }}   │ ◄── DADOS DINÂMICOS
│  {{ $user->email }}  │
└─────────────────────┘
```

O segredo é o `Auth::login($user)` no momento do registo — isso cria a sessão, e depois em qualquer página protegida você acessa `Auth::user()` para pegar todos os dados! 🎯