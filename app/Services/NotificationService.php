<?php
namespace App\Services;
use App\Models\Notification;

class NotificationService {
    public function notify($userId, $tipo, $titulo, $corpo, $refId = null, $refTipo = null) {
        return Notification::create([
            'usuario_id' => $userId,
            'tipo' => $tipo,
            'titulo' => $titulo,
            'corpo' => $corpo,
            'id_referencia' => $refId,
            'tipo_referencia' => $refTipo
        ]);
        // Aqui você integraria o Laravel Reverb / Pusher para notificação push real-time
    }
}