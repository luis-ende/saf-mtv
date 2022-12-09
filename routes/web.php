<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Repositories\SectorRepository;
use App\Repositories\TipoPymeRepository;
use App\Repositories\VialidadRepository;
use App\Http\Controllers\ProductosController;
use App\Repositories\GrupoPrioritarioRepository;
use App\Http\Controllers\OportunidadesController;
use App\Http\Controllers\PerfilNegocioController;
use App\Http\Controllers\CatalogoProductosController;
use App\Http\Controllers\ProgramacionAnualController;
use App\Http\Controllers\CentroNotificacionesController;

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
})->name('homepage');

Route::get('/info-venderle-a-cdmx', function() {
    return view('info.show');
});

Route::get('/oportunidades-de-negocio', [OportunidadesController::class, 'index'])->name('oportunidades-negocio');

Route::post('/oportunidades-de-negocio', [OportunidadesController::class, 'search'])->name('oportunidades-negocio.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/catalogo-productos', [CatalogoProductosController::class, 'index'])->middleware(['auth', 'verified'])->name('catalogo-productos');

Route::get('/perfil-negocio', [PerfilNegocioController::class, 'index'])->middleware(['auth', 'verified'])->name('perfil-negocio');

Route::post('/perfil-negocio/update', [PerfilNegocioController::class, 'update'])->middleware(['auth', 'verified'])->name('perfil-negocio.update');

Route::post('/descripcion-negocio/update', [PerfilNegocioController::class, 'updateDescripcionNegocio'])->middleware(['auth', 'verified'])->name('descripcion-negocio.update');

Route::post('/productos', [ProductosController::class, 'store'])->middleware(['auth', 'verified'])->name('productos.store');

Route::post('/productos/edit/{producto}', [ProductosController::class, 'update'])->middleware(['auth', 'verified'])->name('productos.update');

Route::get('/productos/{producto}/archivos', [ProductosController::class, 'showArchivos'])->middleware(['auth', 'verified'])->name('productos-archivos.show');

Route::post('/productos/{producto}/archivos', [ProductosController::class, 'storeFiles'])->middleware(['auth', 'verified'])->name('productos-archivos.store');

Route::delete('/productos/archivos/{id}', [ProductosController::class, 'deleteFile'])->middleware(['auth', 'verified'])->name('productos-archivos.delete');

Route::get('/productos/edit/{producto}', [ProductosController::class, 'show'])->middleware(['auth', 'verified'])->name('productos.edit');

Route::delete('/productos/delete/{producto}', [ProductosController::class, 'destroy'])->middleware(['auth', 'verified'])->name('productos.destroy');

Route::post('/productos/importacion', [ProductosController::class, 'importProductos'])->middleware(['auth', 'verified'])->name('productos.import');

Route::get('/centro-notificaciones', [CentroNotificacionesController::class, 'index'])->middleware(['auth', 'verified'])->name('centro-notificaciones');

Route::get('/programacion-anual', [ProgramacionAnualController::class, 'index'])->name('programacion-anual');

Route::get('/registro-inicio', function() {
    return view('registro.inicio');
})->name('registro-inicio');

Route::get('/registro-certificado-1', function() {
    return view('registro.inicio-cert-1');
})->name('registro-inicio-certificado-1');

Route::get('/registro-confirmacion', function() {
    return view('registro.inicio-confirmacion');
})->name('registro-inicio-confirmacion');


Route::get('/registro-perfil-negocio', function() {
    $persona = Auth::user()->persona;

    return view('registro.registro-perfil-negocio', [
        'persona' => $persona,
        'tipos_vialidad' => VialidadRepository::obtieneTiposVialidad(),
        'grupos_prioritarios' => GrupoPrioritarioRepository::obtieneGruposPrioritarios(),
        'tipos_pyme' => TipoPymeRepository::obtieneTiposPyme(),
        'sectores' => SectorRepository::obtieneSectores(),
        'categorias_scian' => [], // TODO: Implementar cuando esté listo el catálogo
    ]);    
})->middleware(['auth'])->name('registro-perfil-negocio');

Route::get('/registro-contactos', function() {
    return view('registro.registro-contactos');
})->name('registro-contactos');

require __DIR__.'/auth.php';
