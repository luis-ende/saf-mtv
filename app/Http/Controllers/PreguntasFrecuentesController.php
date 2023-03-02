<?php

namespace App\Http\Controllers;

use App\Repositories\PreguntasFrecuentesRepository;
use Illuminate\Http\Request;

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
}
