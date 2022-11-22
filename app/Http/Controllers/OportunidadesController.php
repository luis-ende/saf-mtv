<?php

namespace App\Http\Controllers;

use App\Spiders\ConvocatoriasOportunidadesSpider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use RoachPHP\Roach;

class OportunidadesController extends Controller
{
    public function show(Request $request)
    {
        Roach::startSpider(ConvocatoriasOportunidadesSpider::class);
        $convocatorias = Roach::collectSpider(ConvocatoriasOportunidadesSpider::class);
        $convocatorias = $convocatorias[0]->all();

        $oportunidades = [];
        foreach($convocatorias as $convocatoria) {
            $oportunidades[$convocatoria['entidad_convocante']][] = $convocatoria;
        }

        return view('oportunidades.show', [
            'categorias' => $oportunidades,
        ]);
    }
}
