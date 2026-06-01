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
})->name('auth.login');


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
Route::post('/registar', [AuthController::class, 'registar'])->name('registar');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Formulários de registro (GET)
Route::prefix('registar')->group(function () {
    Route::get('/cliente', function () {
        return view('registar.cliente');
    })->name('registar.cliente');

    Route::get('/freelancer', function () {
        return view('registar.freela');
    })->name('registar.freela');
});

// Processar registro (POST)
Route::post('/registar', [AuthController::class, 'registar'])->name('registar');

// Para painel do cliente
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/painel/cliente', [ClientDashboardController::class, 'index'])->name('painel.cliente');
    Route::get('/api/cliente/dados', [ClientDashboardController::class, 'getData'])->name('api.cliente.dados');

    // Para painel do freelancer
    Route::get('/painel/freelancer', [FreelancerDashboardController::class, 'index'])->name('painel.freelancer');
    Route::get('/api/freelancer/dados', [FreelancerDashboardController::class, 'getData'])->name('api.freelancer.dados');
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
})->name('painel.freelancer');

Route::get('/painel/cliente/teste', function() {
    return view('painel.painel_cliente');
})->name('painel.cliente');