<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Rotas Públicas
Route::get('/', function () {
    return view('home.inicio');
})->name('inicio');

Route::get('/escolher-funcao', function () {
    return view('home.pagina_escolher_funcao');
})->name('pagina_escolher_funcao');


Route::get('/login', function() {
    return view('registar.tela_login');
})->name('login');


Route::get('/registar/cliente', function() {
    return view('registar.cliente');
})->name('registar.cliente');

Route::get('/registar/freelancer', function() {
    return view('registar.freelancer');
})->name('registar.freelancer');

// Auth Routes
Route::post('/registar', [AuthController::class, 'registar']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::post('/logout-api', [AuthController::class, 'logoutApi'])->name('logout.api');
Route::get('/check-auth', [AuthController::class, 'checkAuth'])->name('check.auth');
Route::post('/refresh-token', [AuthController::class, 'refresh'])->name('refresh.token');

// Rotas Protegidas
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/painel/cliente', [DashboardController::class, 'cliente'])
        ->name('painel.cliente');
    
    Route::get('/painel/freelancer', [DashboardController::class, 'freelancer'])
        ->name('painel.freelancer');
    
    Route::get('/api/freelancer/dashboard', [DashboardController::class, 'freelancerData'])
        ->name('api.freelancer.dashboard');
    
    Route::get('/api/cliente/dashboard', [DashboardController::class, 'clienteData'])
        ->name('api.cliente.dashboard');
});

// Formulários de registro (GET)
Route::prefix('registar')->group(function () {
    Route::get('/cliente', function () {
        return view('registar.cliente');
    })->name('registar.cliente');

    Route::get('/freelancer', function () {
        return view('registar.freela');
    })->name('registar.freela');
});




// ============================================
// PERFIS
// ============================================

Route::prefix('profiles')->group(function () {
    Route::get('/{id}', [ProfileController::class, 'show']);
    Route::put('/{id}', [ProfileController::class, 'update']);
    Route::post('/{id}/skills', [ProfileController::class, 'updateSkills']);
});

Route::get('/painel/freelancer/teste', function() {
    return view('painel.painel_freelancer');
})->name('painel.freelancer.teste');

Route::get('/painel/cliente/teste', function() {
    return view('painel.painel_cliente');
})->name('painel.cliente.teste');


use App\Http\Controllers\Freelancer\JobController;
use App\Http\Controllers\Freelancer\ProposalController;

Route::middleware(['jwt.auth', 'role:freelancer'])
    ->prefix('freelancer')
    ->name('freelancer.')
    ->group(function () {

        // Dashboard (já existente)
        Route::get('/painel/freelancer', [DashboardController::class, 'index'])
            ->name('painel.freelancer');

        // ===== JOBS =====
        Route::prefix('jobs')->name('jobs.')->group(function () {
            Route::get('/',           [JobController::class, 'index'])   ->name('index');
            Route::get('/{job}',      [JobController::class, 'show'])    ->name('show');
            Route::post('/{job}/save',[JobController::class, 'toggleSave'])->name('save');
        });

        // ===== PROPOSTAS =====
        Route::prefix('proposals')->name('proposals.')->group(function () {
            Route::get('/',    [ProposalController::class, 'index']) ->name('index');
            Route::post('/',   [ProposalController::class, 'store']) ->name('store');
        });

        // Rotas placeholder para o layout não quebrar
        Route::get('/mensagens',  fn() => view('freelancer.messages.index'))  ->name('messages.index');
        Route::get('/carteira',   fn() => view('freelancer.wallet.index'))    ->name('wallet.index');
        Route::get('/perfil',     fn() => view('freelancer.profile.index'))   ->name('profile.index');
        Route::get('/definicoes', fn() => view('freelancer.settings.index'))  ->name('settings.index');
        Route::get('/creditos',   fn() => view('freelancer.credits.index'))   ->name('credits.index');

        Route::get('/perfil/{id}', fn($id) => view('freelancer.profile.show', ['userId' => $id]))
            ->name('profile.show');
    });