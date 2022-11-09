<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('proveedores/registro/{rfc}', [\App\Http\Controllers\Api\ProveedoresController::class, 'verificaRFCRegistro']);

Route::get('proveedores/login/{rfc}', [\App\Http\Controllers\Api\ProveedoresController::class, 'verificaRFCLogin']);

Route::get('contacto/asentamientos/{cp}', [\App\Http\Controllers\Api\ContactoController::class, 'consultaInfoDomicilio']);

Route::get('contacto/curp/{curp}', [\App\Http\Controllers\Api\ContactoController::class, 'consultaCURP']);

Route::get('catalogo_cabms/{tipo_producto}/{criterio_busqueda}', [\App\Http\Controllers\Api\CatalogoCABMSController::class, 'buscaClavesCABMS']);

// TODO: API Endpoints de prueba para modo local de desarrollo, remover...
Route::get('etapa_proveedor/{rfc}', function(Request $request) {
    return response()->json([[
        'rfc' => "JUAA810316M17",
        'es_usuario' => false,
        'id_etapa' => '7',
        'etapa' => "CONSTANCIA",
    ]]);
});

Route::get('consulta_curp/{curp}', function(Request $request) {
    return response()->json([
        'error' => [
            'msg' => 'Datos obtenidos correctamente',
            'code' => 0,
        ],
        'data' => [[
            'CURP' => 'FOGG851019HDFLRL02',
            'nombres' => 'NOMBRE PRUEBA',
            'apellido1' => 'APELLIDO',
            'apellido2' => 'APELLIDO',
            'sexo' => 'H',
            'cveEntidadNac' => 'DF',
            'fechNac' => '19/10/1990',
            'nacionalidad' => 'MEX',
            'anioReg' => '1990',
            'statusCurp' => 'RCN'
        ]]
    ]);
});
