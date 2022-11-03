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

// TODO: API Endpoint de prueba, remover...
Route::get('etapa_proveedor/{rfc}', function(Request $request) {
    return response()->json([[
        'rfc' => "JUAA810316M17",
        'es_usuario' => true,
        'id_etapa' => '10',
        'etapa' => "SOLICITUD VENCIDA",
    ]]);
});
