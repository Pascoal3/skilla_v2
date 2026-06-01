<?php
namespace App\Services;
use App\Models\Conversation;
use App\Models\Message;
use Carbon\Carbon;

class ChatService {
    public function getOrCreateConversation($contractId, $clientId, $freelancerId) {
        return Conversation::firstOrCreate(
            ['contrato_id' => $contractId],
            ['cliente_id' => $clientId, 'freelancer_id' => $freelancerId]
        );
    }

    public function sendMessage($conversationId, $senderId, array $data) {
        $message = Message::create([
            'conversa_id' => $conversationId,
            'remetente_id' => $senderId,
            'conteudo' => $data['conteudo'] ?? null,
            'tipo_mensagem' => $data['tipo'] ?? 'texto',
            'url_arquivo' => $data['url_arquivo'] ?? null,
            'nome_arquivo' => $data['nome_arquivo'] ?? null,
            'tamanho_arquivo' => $data['tamanho_bytes'] ?? null,
            'criado_em' => Carbon::now(),
        ]);

        Conversation::where('id', $conversationId)->update(['ultima_mensagem_em' => Carbon::now()]);

        return $message;
    }
}