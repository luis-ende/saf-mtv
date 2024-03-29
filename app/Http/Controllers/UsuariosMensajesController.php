<?php

namespace App\Http\Controllers;

use App\Mail\ProveedorSolicitudInfo;
use App\Models\User;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UsuariosMensajesController extends Controller
{
    public function send(Request $request)
    {
        try {
            $this->validate($request, [
                'user_from' => 'int',
                'user_to' => 'int',
                'asunto' => 'string',
                'mensaje' => 'string',
            ]);

            $thread = Thread::create([
                'subject' => $request->input('asunto'),
            ]);

            Message::create([
                'thread_id' => $thread->id,
                'user_id' => $request->input('user_from'),
                'body' => $request->input('mensaje'),
            ]);

            // Sender
            Participant::create([
                'thread_id' => $thread->id,
                'user_id' => $request->input('user_from'),
                'last_read' => new Carbon(),
            ]);

            // Recipients
            $thread->addParticipant($request->input('user_to'));

            $this->enviarNotificacionesEmail($request);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor.'], 400);
        }        

        return response()->json(true);
    }

    public function index() 
    {
        // Obtener threads de un usuario:
        // Cmgmyr\Messenger\Models\Thread::forUser(4)->get();
    }

    private function enviarNotificacionesEmail(Request $request): void
    {
        $userFrom = User::find($request->input('user_from'));
        $userTo = User::find($request->input('user_to'));
        $mailable = new ProveedorSolicitudInfo(
            $userFrom->urg,
            $request->input('asunto'),
            $request->input('mensaje')
        );

        Mail::to($userTo->persona->email)->send($mailable);
    }
}
