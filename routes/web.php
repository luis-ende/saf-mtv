<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\RegistroMTVController;
use App\Http\Controllers\CatalogoCABMSController;
use App\Http\Controllers\OportunidadesController;
use App\Http\Controllers\PerfilNegocioController;
use App\Http\Controllers\CatalogoProductosController;
use App\Http\Controllers\ProgramacionAnualController;
use App\Http\Controllers\CentroNotificacionesController;
use App\Http\Controllers\UsuarioConfiguracionController;

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
})->name('flujograma.show');

Route::get('/oportunidades-de-negocio', [OportunidadesController::class, 'index'])->name('oportunidades-negocio');

Route::post('/oportunidades-de-negocio', [OportunidadesController::class, 'search'])->name('oportunidades-negocio.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'registro_mtv.status'])->name('dashboard');

// TODO: Crear grupos

Route::post('persona/{persona}/contactos', [PersonaController::class, 'storeContactos'])->middleware('auth')->name('persona-contactos.store');

Route::get('/catalogo-productos', [CatalogoProductosController::class, 'index'])
    ->middleware(['auth', 'verified', 'registro_mtv.status'])->name('catalogo-productos');

Route::get('/perfil-negocio', [PerfilNegocioController::class, 'show'])
    ->middleware(['auth', 'verified', 'registro_mtv.status'])->name('perfil-negocio');

Route::post('/perfil-negocio/update', [PerfilNegocioController::class, 'update'])->middleware(['auth', 'verified'])->name('perfil-negocio.update');

Route::post('/productos', [ProductosController::class, 'store'])->middleware(['auth', 'verified'])->name('productos.store');

Route::post('/productos/edit/{producto}', [ProductosController::class, 'update'])->middleware(['auth', 'verified'])->name('productos.update');

Route::get('/productos/{producto}/archivos', [ProductosController::class, 'showArchivos'])
    ->middleware(['auth', 'verified', 'registro_mtv.status'])->name('productos-archivos.show');

Route::post('/productos/{producto}/archivos', [ProductosController::class, 'storeFiles'])->middleware(['auth', 'verified'])->name('productos-archivos.store');

Route::delete('/productos/archivos/{id}', [ProductosController::class, 'deleteFile'])->middleware(['auth', 'verified'])->name('productos-archivos.delete');

Route::get('/productos/edit/{producto}', [ProductosController::class, 'show'])
    ->middleware(['auth', 'verified', 'registro_mtv.status'])->name('productos.edit');

Route::delete('/productos/delete/{producto}', [ProductosController::class, 'destroy'])->middleware(['auth', 'verified'])->name('productos.destroy');

Route::post('/productos/importacion', [ProductosController::class, 'importProductos'])->middleware(['auth', 'verified'])->name('productos.import');

Route::get('/centro-notificaciones', [CentroNotificacionesController::class, 'index'])->middleware(['auth', 'verified'])->name('centro-notificaciones');

Route::get('/programacion-anual', [ProgramacionAnualController::class, 'index'])->name('programacion-anual');

Route::get('/registro-inicio', [RegistroMTVController::class, 'showRegistroInicio'])->name('registro-inicio');

Route::get('/registro-identificacion/{tipoPersona}/{tipoRegistro}',
    [RegistroMTVController::class, 'showRegistroIdentificacion'])->name('registro-inicio-identificacion');

Route::post('/registro-identificacion', [RegistroMTVController::class, 'storeRegistroCert'])->name('registro-inicio-identificacion.store');

Route::post('/registro-confirmacion', [RegistroMTVController::class, 'storeRegistroCreaCuenta'])->name('registro-inicio-confirmacion.store');

Route::get('/registro-perfil-negocio', [RegistroMTVController::class, 'showRegistroPerfilNegocio'])->middleware(['auth'])->name('registro-perfil-negocio.show');
Route::post('/registro-perfil-negocio', [RegistroMTVController::class, 'storeRegistroPerfilNegocio'])->middleware(['auth'])->name('registro-perfil-negocio.store');

Route::get('/registro-contactos', [RegistroMTVController::class, 'showRegistroContactos'])->middleware(['auth'])->name('registro-contactos.show');

Route::post('/registro-contactos', [RegistroMTVController::class, 'storeRegistroContactos'])->middleware(['auth'])->name('registro-contactos.store');

Route::get('/perfil-negocio/categorias_scian/{id_sector?}', [PerfilNegocioController::class, 'categoriasScianIndex'])->middleware('auth')->name('categorias-scian.index');

Route::get('/perfil-negocio/categorias_scian/{keyword}', [PerfilNegocioController::class, 'categoriasScianPorPalabraClave'])->middleware('auth')->name('categorias-scian.search');

Route::get('/configuracion', [UsuarioConfiguracionController::class, 'show'])->middleware('auth')->name('usuario-configuracion.show');

Route::post('/configuracion', [UsuarioConfiguracionController::class, 'update'])->middleware('auth')->name('usuario-configuracion.update');

Route::get('/catalogo-cabms/{criterio_busqueda}', [CatalogoCABMSController::class, 'buscaClavesCABMS'])->middleware('auth')->name('catalogo-cabms.search');
Route::get('/catalogo-cabms/categorias/{cabms}', [CatalogoCABMSController::class, 'buscaCategorias'])->middleware('auth')->name('catalogo-cabms-categorias.search');

Route::get('/catalogo-registro-inicio', [CatalogoProductosController::class, 'showRegistroInicio'])->middleware('auth')->name('catalogo-registro-inicio');

Route::get('/alta-producto-1', [CatalogoProductosController::class, 'showAltaProducto1'])->middleware('auth')->name('alta-producto-1.show');
Route::get('/alta-producto-2/{producto}', [CatalogoProductosController::class, 'showAltaProducto2'])->middleware('auth')->name('alta-producto-2.show');
Route::get('/alta-producto-3/{producto}', [CatalogoProductosController::class, 'showAltaProducto3'])->middleware('auth')->name('alta-producto-3.show');
Route::get('/alta-producto-4/{producto}', [CatalogoProductosController::class, 'showAltaProducto4'])->middleware('auth')->name('alta-producto-4.show');
Route::post('/alta-producto/{paso}/{producto?}', [CatalogoProductosController::class, 'storeAltaProducto'])->middleware('auth')->name('alta-producto.store');

Route::get('/carga-productos-1', [CatalogoProductosController::class, 'showImportacionProductos1'])->middleware('auth')->name('importacion-productos-1.show');
Route::get('/carga-productos-2', [CatalogoProductosController::class, 'showImportacionProductos2'])->middleware('auth')->name('importacion-productos-2.show');
Route::post('/carga-productos/{paso}', [CatalogoProductosController::class, 'storeCargaProductos'])->middleware('auth')->name('carga-productos.store');

require __DIR__.'/auth.php';
