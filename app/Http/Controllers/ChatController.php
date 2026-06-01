<?php

namespace App\Http\Controllers;
use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller {
    public function __construct(protected ChatService $chatService) {}

    public function send(Request $request) {
        $userId = $request->header('X-User-Id');
        $message = $this->chatService->sendMessage($request->conversa_id, $userId, $request->all());
        return response()->json($message);
    }

    public function messages($conversaId) {
        return response()->json(\App\Models\Message::where('conversa_id', $conversaId)->orderBy('criado_em', 'asc')->get());
    }
}
