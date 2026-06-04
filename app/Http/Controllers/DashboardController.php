<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class DashboardController extends Controller
{

    public function freelancer()
    {
        return view('painel.painel_freelancer');
    }

    public function cliente()
    {
        return view('painel.painel_cliente');
    }

    public function freelancerData(Request $request)
    {
        try {
            $token = $request->cookie('jwt_token');
            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user || $user->funcao !== 'freelancer') {
                return response()->json(['error' => 'Não autorizado'], 403);
            }

            return response()->json([
                'user' => [
                    'id' => $user->id,
                    'primeiro_nome' => $user->primeiro_nome,
                    'sobrenome' => $user->sobrenome,
                    'email' => $user->email,
                    'funcao' => $user->funcao,
                    'foto_perfil' => $user->foto_perfil,
                    'rating' => $user->avaliacao_media ?? 0,
                    'provincia' => $user->provincia
                ],
                'metrics' => [
                    'trabalhos_ativos' => $user->trabalhosAtivos()->count(),
                    'propostas_enviadas' => $user->propostas()->count(),
                    'propostas_pendentes' => $user->propostas()->where('status', 'pendente')->count(),
                    'total_ganho' => $user->carteira->ganhos_totais ?? 0,
                    'creditos' => $user->carteira->creditos ?? 0,
                    'em_escrow' => $user->carteira->em_escrow ?? 0,
                    'avaliacao_media' => $user->avaliacao_media ?? 0,
                    'jobs_concluidos' => $user->jobsConcluidos()->count(),
                    'saldo_carteira' => $user->carteira->saldo ?? 0
                ],
                'active_job' => $user->trabalhosAtivos()->first(),
                'recent_proposals' => $user->propostas()->with('trabalho')->latest()->take(3)->get(),
                'recommended_jobs' => [], // Implementar lógica de recomendação
                'notifications_count' => $user->notificacoes()->unread()->count()
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao carregar dados'], 500);
        }
    }

    public function clienteData(Request $request)
    {
        // Similar ao freelancer, mas com dados do cliente
        try {
            $token = $request->cookie('jwt_token');
            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user || $user->funcao !== 'cliente') {
                return response()->json(['error' => 'Não autorizado'], 403);
            }

            return response()->json([
                'user' => [
                    'id' => $user->id,
                    'primeiro_nome' => $user->primeiro_nome,
                    'sobrenome' => $user->sobrenome,
                    'email' => $user->email,
                    'funcao' => $user->funcao,
                    'foto_perfil' => $user->foto_perfil,
                    'provincia' => $user->provincia
                ],
                'metrics' => [
                    'trabalhos_publicados' => $user->trabalhos()->count(),
                    'trabalhos_ativos' => $user->trabalhos()->where('status', 'aberto')->count(),
                    'propostas_recebidas' => $user->propostasRecebidas()->count(),
                    'saldo_carteira' => $user->carteira->saldo ?? 0
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao carregar dados'], 500);
        }
    }
}