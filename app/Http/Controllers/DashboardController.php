<?php

class DashboardController extends Controller
{
    // VIEW (página HTML)
    public function freelancer(Request $request)
    {
        $user = $request->user();
        return view('painel.painel_freelancer', compact('user'));
    }

    public function cliente(Request $request)
    {
        $user = $request->user();
        return view('painel.painel_cliente', compact('user'));
    }

    // API (dados JSON para o frontend)
    public function freelancerData(Request $request)
    {
        $token = $request->cookie('jwt_token');

        if (!$token) {
            return response()->json(['error' => 'Token não fornecido'], 401);
        }

        $user = \Tymon\JWTAuth\Facades\JWTAuth::setToken($token)->authenticate();

        if (!$user || $user->funcao !== 'freelancer') {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        return response()->json([
            'user' => $user,
            'metrics' => []
        ]);
    }

    public function clienteData(Request $request)
    {
        $token = $request->cookie('jwt_token');

        if (!$token) {
            return response()->json(['error' => 'Token não fornecido'], 401);
        }

        $user = \Tymon\JWTAuth\Facades\JWTAuth::setToken($token)->authenticate();

        if (!$user || $user->funcao !== 'cliente') {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        return response()->json([
            'user' => $user,
            'metrics' => []
        ]);
    }
}