<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoFormularioRequest;
use App\Mail\ContactoFormularioMail;
use App\Repositories\PreguntasFrecuentesRepository;
use Illuminate\Support\Facades\Mail;

class PreguntasFrecuentesController extends Controller
{
    public function show()
    {
        return view('preguntas-frecuentes.show');
    }

    public function list(PreguntasFrecuentesRepository $preguntasFrecRepo, ?int $categoria = null, ?int $subcategoria = null)
    {
        $preguntas = $preguntasFrecRepo->obtienePreguntasFrecuentes($categoria, $subcategoria);

        return response()->json($preguntas);
    }

    public function formStore(ContactoFormularioRequest $request)
    {
        $mailable = new ContactoFormularioMail(
            mensajeInfo: $request->only('nombre', 'ubicacion', 'email',
                                             'tipo_persona', 'tipo_empresa', 'mensaje')
        );

        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send($mailable);

            return redirect()->back()->with('success', 'Mensaje enviado exitosamente.');
        } catch(\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Error al enviar correo. No fue posible enviar el mensaje.')
                            ->withInput();
        }
    }
}
