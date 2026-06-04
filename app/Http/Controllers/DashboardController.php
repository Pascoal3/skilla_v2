<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function freelancer(Request $request)
    {
        return view('painel.painel_freelancer', [
            'user' => $request->user(),
        ]);
    }

    public function cliente(Request $request)
    {
        return view('painel.painel_cliente', [
            'user' => $request->user(),
        ]);
    }

    public function freelancerData(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => $this->userPayload($user),
            'metrics' => [],
        ]);
    }

    public function clienteData(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => $this->userPayload($user),
            'metrics' => [],
        ]);
    }

    private function userPayload($user): array
    {
        return [
            'id' => $user->id,
            'primeiro_nome' => $user->primeiro_nome,
            'sobrenome' => $user->sobrenome,
            'email' => $user->email,
            'funcao' => $user->funcao,
            'nome_usuario' => $user->nome_usuario,
            'url_avatar' => $user->url_avatar,
        ];
    }
}
