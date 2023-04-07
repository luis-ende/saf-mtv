<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoFormularioRequest;
use App\Mail\NotificacionFormularioContacto;
use App\Mail\NotificacionFormularioContactoUsuario;
use App\Repositories\PreguntasFrecuentesRepository;
use App\Repositories\TipoPymeRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;

class PreguntasFrecuentesController extends Controller
{
    public function show()
    {
        $tipos_empresa = TipoPymeRepository::obtieneTiposPyme();

        return view('preguntas-frecuentes.show', compact('tipos_empresa'));
    }

    public function list(PreguntasFrecuentesRepository $preguntasFrecRepo, ?int $categoria = null, ?int $subcategoria = null)
    {
        $preguntas = $preguntasFrecRepo->obtienePreguntasFrecuentes($categoria, $subcategoria);
        $this->procesaRespuestasHtml($preguntas);

        return response()->json($preguntas);
    }

    private function procesaRespuestasHtml(Collection $preguntas)
    {
        $htmlDoc = new \DOMDocument();
        $htmlDoc->encoding='UTF-8';
        foreach ($preguntas as $pregunta) {
            $html = $pregunta->respuesta;
            $htmlDoc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'),
                LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $links = $htmlDoc->getElementsByTagName('a');
            foreach ($links as $link) {
                $link->setAttribute('class', 'mtv-link-gold font-bold');
                $link->setAttribute('target', '_blank');
            }
            $pregunta->respuesta = $htmlDoc->saveHTML();
        }
    }

    public function formStore(ContactoFormularioRequest $request)
    {
        $mailableToAdmin = new NotificacionFormularioContacto(
            mensajeInfo: $request->only('nombre', 'ubicacion', 'email',
                                             'tipo_persona', 'tipo_empresa', 'mensaje')
        );

        $mailableToUser = new NotificacionFormularioContactoUsuario();

        //try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send($mailableToAdmin);
            Mail::to($request->input('email'))->send($mailableToUser);

            return redirect()->back()->with('success', 'Mensaje enviado exitosamente.');
        /*} catch(\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Error al enviar correo. No fue posible enviar el mensaje.')
                            ->withInput();
        }*/
    }
}
