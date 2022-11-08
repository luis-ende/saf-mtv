<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogoProductosController;
use App\Http\Controllers\PerfilNegocioController;
use App\Http\Controllers\CentroNotificacionesController;
use App\Http\Controllers\ProductosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info-venderle-a-cdmx', function() {
    return view('info.show');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/catalogo-productos', [CatalogoProductosController::class, 'index'])->middleware(['auth', 'verified'])->name('catalogo-productos');

Route::get('/perfil-negocio', [PerfilNegocioController::class, 'index'])->middleware(['auth', 'verified'])->name('perfil-negocio');

Route::get('/centro-notificaciones', [CentroNotificacionesController::class, 'index'])->middleware(['auth', 'verified'])->name('centro-notificaciones');

Route::post('/productos', [ProductosController::class, 'store'])->middleware(['auth', 'verified'])->name('productos.store');

Route::post('/productos/edit/{producto}', [ProductosController::class, 'update'])->middleware(['auth', 'verified'])->name('productos.update');

Route::get('/productos/edit/{producto}', [ProductosController::class, 'show'])->middleware(['auth', 'verified'])->name('productos.edit');

Route::delete('/productos/delete/{producto}', [ProductosController::class, 'destroy'])->middleware(['auth', 'verified'])->name('productos.destroy');

require __DIR__.'/auth.php';
