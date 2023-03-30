<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class UsuariosMensajesRepository
{
    /**
     * Obtiene el número de mensajes que ha recibido un usuario con un subject específico.
     */
    public function obtieneNumMensajesProveedor(int $userId, string $subject): int
    {
        return DB::table('messenger_participants AS mp')
                    ->join('messenger_threads AS mt', 'mt.id', 'mp.thread_id')
                    ->where([['mp.user_id', $userId], ['mt.subject', $subject]])
                    ->count();
    }
}