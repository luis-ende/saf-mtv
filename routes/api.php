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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});*/

Route::post('/usuarios-urg/register', [\App\Http\Controllers\Api\UrgAuthController::class, 'registraUsuarioUrg']);
// @todo Endpoint para registrar proveedores vía API
//Route::post('/usuarios-urg/login', [\App\Http\Controllers\Api\AuthController::class, 'loginUsuarioUrg']);

Route::get('proveedores/registro/{rfc}', [\App\Http\Controllers\Api\ProveedoresController::class, 'verificaRFCRegistro']);

Route::get('proveedores/login/{rfc}', [\App\Http\Controllers\Api\ProveedoresController::class, 'verificaRFCLogin']);

Route::get('contacto/asentamientos/{cp}', [\App\Http\Controllers\Api\ContactoController::class, 'consultaInfoDomicilio']);

Route::get('contacto/curp/{curp}', [\App\Http\Controllers\Api\ContactoController::class, 'consultaCURP']);

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
