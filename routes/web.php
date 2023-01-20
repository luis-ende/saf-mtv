<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RegistroMTVController;
use App\Http\Controllers\CatalogoCABMSController;
use App\Http\Controllers\OportunidadesController;
use App\Http\Controllers\PerfilNegocioController;
use App\Http\Controllers\BuscadorMTVController;
use App\Http\Controllers\CatalogoProductosController;
use App\Http\Controllers\ProgramacionAnualController;
use App\Http\Controllers\CentroNotificacionesController;
use App\Http\Controllers\EntidadURGController;
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

Route::post('persona/{persona}/contactos', [PersonaController::class, 'storeContactos'])
        ->middleware(['role:proveedor', 'auth'])
        ->name('persona-contactos.store');

Route::get('/productos/{producto}/cabms_categorias', [ProductosController::class, 'obtieneProductoCABMSCategorias'])
    ->middleware(['auth', 'verified', 'registro_mtv.status'])->name('productos-cabms-categorias.show');

Route::controller(RegistroMTVController::class)->group(function () {
    Route::middleware(['guest'])->group(function() {
        Route::get('/registro-inicio', 'showRegistroInicio')->name('registro-inicio');
        Route::get('/registro-identificacion/{tipoPersona}/{tipoRegistro}', 'showRegistroIdentificacion')->name('registro-inicio-identificacion');
        Route::post('/registro-identificacion', 'storeRegistroCert')->name('registro-inicio-identificacion.store');
        Route::post('/registro-confirmacion', 'storeRegistroCreaCuenta')->name('registro-inicio-confirmacion.store');
    });

    Route::middleware(['auth', 'role:proveedor'])->group(function() {
        Route::get('/registro-perfil-negocio', 'showRegistroPerfilNegocio')->middleware(['auth'])->name('registro-perfil-negocio.show');
        Route::post('/registro-perfil-negocio', 'storeRegistroPerfilNegocio')->middleware(['auth'])->name('registro-perfil-negocio.store');

        Route::get('/registro-contactos', 'showRegistroContactos')->middleware(['auth'])->name('registro-contactos.show');
        Route::post('/registro-contactos', 'storeRegistroContactos')->middleware(['auth'])->name('registro-contactos.store');
    });
});

Route::get('/perfil-negocio/categorias_scian/{id_sector?}', [PerfilNegocioController::class, 'categoriasScianIndex'])->middleware('auth')->name('categorias-scian.index');
Route::get('/perfil-negocio/categorias_scian/{keyword}', [PerfilNegocioController::class, 'categoriasScianPorPalabraClave'])->middleware('auth')->name('categorias-scian.search');

Route::get('/catalogo-cabms/{criterio_busqueda}', [CatalogoCABMSController::class, 'buscaClavesCABMS'])->middleware('auth')->name('catalogo-cabms.search');
Route::get('/catalogo-cabms/categorias/{cabms}', [CatalogoCABMSController::class, 'buscaCategorias'])->middleware('auth')->name('catalogo-cabms-categorias.search');

Route::middleware(['role:proveedor', 'auth', 'verified', 'registro_mtv.status'])->group(function() {
    Route::get('/perfil-negocio', [PerfilNegocioController::class, 'show'])->name('perfil-negocio');
    Route::post('/perfil-negocio/update', [PerfilNegocioController::class, 'update'])->name('perfil-negocio.update');

    Route::get('/configuracion', [UsuarioConfiguracionController::class, 'show'])->name('usuario-configuracion.show');
    Route::post('/configuracion', [UsuarioConfiguracionController::class, 'update'])->name('usuario-configuracion.update');

    Route::controller(CatalogoProductosController::class)->group(function () {
        Route::get('/catalogo-registro-inicio', 'showRegistroInicio')->name('catalogo-registro-inicio');

        Route::get('/alta-producto-1/{producto?}', 'showAltaProducto1')->name('alta-producto-1.show');
        Route::get('/alta-producto-2/{producto}', 'showAltaProducto2')->name('alta-producto-2.show');
        Route::get('/alta-producto-3/{producto}', 'showAltaProducto3')->name('alta-producto-3.show');
        Route::get('/alta-producto-4/{producto}', 'showAltaProducto4')->name('alta-producto-4.show');
        Route::post('/alta-producto/{paso}/{producto?}', 'storeAltaProducto')->name('alta-producto.store');

        Route::get('/carga-productos-1', 'showImportacionProductos1')->name('importacion-productos-1.show');
        Route::get('/carga-productos-2', 'showImportacionProductos2')->name('importacion-productos-2.show');
        Route::get('/carga-productos-3', 'showImportacionProductos3')->name('importacion-productos-3.show');
        Route::post('/carga-productos/{paso}', 'storeCargaProductos')->name('carga-productos.store');
        Route::post('/carga-productos/producto/{producto}', 'storeCargaProductosProducto')->name('carga-productos.producto.store');
    });

    Route::get('/catalogo-productos', [CatalogoProductosController::class, 'index'])->name('catalogo-productos');

    Route::get('/productos/show/{producto}', [ProductosController::class, 'show'])->name('productos.show');
    Route::post('/productos/edit/{producto}', [ProductosController::class, 'update'])->name('productos.update');
    Route::delete('/productos/delete/{producto}', [ProductosController::class, 'destroy'])->name('productos.destroy');
    Route::get('/productos/{producto}/fotos', [ProductosController::class, 'showFotos'])->name('productos-fotos.show');
});

Route::get('/proveedor/catalogo-productos/{catalogo}', [ProveedorController::class, 'showCatalogoProductos'])->name('proveedor-catalogo-productos.show');
Route::get('/proveedor/producto/{producto}', [ProveedorController::class, 'showProducto'])->name('proveedor-producto.show');
Route::get('/proveedor/perfil/{persona}', [ProveedorController::class, 'showPerfilNegocio'])->name('proveedor-perfil.show');

Route::get('/buscador-mtv/{tipo?}', [BuscadorMTVController::class, 'index'])->name('buscador-mtv.index');
Route::post('/buscador-mtv/{tipo}/{keyword?}', [BuscadorMTVController::class, 'search'])->name('buscador-mtv.search');

Route::middleware(['role:urg', 'auth'])->group(function() {
    Route::controller(EntidadURGController::class)->group(function () {
        Route::get('/urg-productos/favoritos', 'indexFavoritos')->name('urg-productos-favoritos.index');
        Route::post('/urg-productos/favoritos/{producto}', 'updateProductoFavoritos')->name('urg-productos-favoritos.update');
        Route::get('/urg-productos/favoritos/export', 'exportProductosFavoritos')->name('urg-productos-favoritos.export');
    });
});

Route::get('/centro-notificaciones', [CentroNotificacionesController::class, 'index'])->middleware(['auth', 'verified'])->name('centro-notificaciones');

Route::get('/programacion-anual', [ProgramacionAnualController::class, 'index'])->name('programacion-anual');

require __DIR__.'/auth.php';
