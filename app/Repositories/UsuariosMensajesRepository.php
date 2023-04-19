<?php

namespace App\Repositories;

use App\Models\User;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UsuariosMensajesRepository
{
    /**
     * Obtiene los mensajes del proveedor para el escritorio.
     */
    public function obtieneMensajesProveedor(int $userId): Collection
    {
        $threads = Thread::forUserWithNewMessages($userId)
                    ->latest('updated_at')
                    ->with('participants')
                    ->get();

        $opnRepo = new OportunidadNegocioRepository();
        $catUnidadesCompradoras = $opnRepo->obtieneInstitucionesCompradoras();

        return $threads->map(function($t) use($userId, $catUnidadesCompradoras) {
            // Se asume que el thread tiene solamente de dos participantes, el proveedor y un usuario URG.
            $threadParticipantUrg = $t->participants->first(function ($p) use($userId) {
                return $p->id !== $userId;
            });
            $usuarioUrg = User::find($threadParticipantUrg->user_id);
            $nombreUrg = '';
            if ($usuarioUrg->urg) {
                // Mostrar nombre de usuario por default o nombre de unidad compradora si está asignado
                $nombreUrg = $usuarioUrg->urg->nombre;
                $unidadCompradoraId = $usuarioUrg->urg->id_unidad_compradora;
                if ($unidadCompradoraId) {
                    $uc = $catUnidadesCompradoras->firstWhere('id', $unidadCompradoraId);
                    $nombreUrg = $uc->nombre;
                }
            }

            return [
                'thread_id' => $t->id,
                'user_name' => $nombreUrg,
                'subject' => $t->subject,
                'updated_at' => $t->updated_at,
            ];
        });
    }

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