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

Route::get('consulta_curp/{curp}', function(Request $request, string $curp) {
    if (env('APP_ENV') === 'local') {
        return response()->json([
            'error' => [
                'msg' => 'Datos obtenidos correctamente',
                'code' => 0,
            ],
            'data' => [[
                'CURP' => $curp,
                'nombres' => 'Nombre',
                'apellido1' => 'Apellido1',
                'apellido2' => 'Apellido2',
                'sexo' => 'H',
                'cveEntidadNac' => 'DF',
                'fechNac' => '01/01/2000',
                'nacionalidad' => 'MEX',
                'anioReg' => '1990',
                'statusCurp' => 'RCN'
            ]]
        ]);
    }
});
