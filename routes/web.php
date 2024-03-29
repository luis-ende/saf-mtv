<?php

use App\Http\Controllers\DirectorioController;
use App\Http\Controllers\EscritorioMTVController;
use App\Http\Controllers\PreguntasFrecuentesController;
use App\Http\Controllers\RegistroURGController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EntidadURGController;
use App\Http\Controllers\BuscadorMTVController;
use App\Http\Controllers\RegistroMTVController;
use App\Http\Controllers\CatalogoCABMSController;
use App\Http\Controllers\OportunidadesController;
use App\Http\Controllers\PerfilNegocioController;
use App\Http\Controllers\ComprasDetalleController;
use App\Http\Controllers\UsuariosMensajesController;
use App\Http\Controllers\CalendarioComprasController;
use App\Http\Controllers\CatalogoProductosController;
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
    return view('flujograma.show');
})->name('flujograma.show');

Route::get('/aviso-privacidad', function() {
    return view('aviso-privacidad.show');
})->name('aviso-privacidad.show');

Route::controller(PreguntasFrecuentesController::class)->group(function () {
    Route::get('/preguntas-frecuentes', 'show')->name('preguntas-frecuentes.show');
    Route::get('/preguntas-frecuentes/list/{categoria?}/{subcategoria?}', 'list')->name('preguntas-frecuentes.list');
    Route::post('/preguntas-frecuentes/contacto', 'formStore')->name('preguntas-frecuentes-form.store');
});

Route::controller(DirectorioController::class)->group(function () {
    Route::get('/directorio', 'index')->name('directorio.index');
});

Route::get('/escritorio', [EscritorioMTVController::class, 'show'])
    ->middleware(['auth', 'verified', 'registro_mtv.status'])->name('dashboard');

Route::post('persona/{persona}/contactos', [PersonaController::class, 'storeContactos'])
        ->middleware(['role:proveedor', 'auth'])
        ->name('persona-contactos.store');

Route::get('/productos/{producto}/cabms_categorias', [ProductosController::class, 'obtieneProductoCABMSCategorias'])
    ->middleware(['auth', 'verified', 'registro_mtv.status'])->name('productos-cabms-categorias.show');

// El registro se hará vía Acceso único
/*Route::controller(RegistroURGController::class)->group(function () {
    Route::middleware(['guest'])->group(function() {
        Route::get('/registro-urg', 'show')->name('registro-urg.show');
        Route::post('/registro-urg', 'store')->name('registro-urg.store');
    });
});*/

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
    
    Route::controller(CentroNotificacionesController::class)->group(function () {
        Route::get('/centro-notificaciones', function() {  
            return redirect()->route('centro-notificaciones.index', [1]);
        })->name('centro-notificaciones.index');
        Route::get('/centro-notificaciones/{seccion}', 'index')->name('centro-notificaciones.index');
        Route::delete('/notificaciones/sugerencias/delete/{oportunidad}', 'destroy')->name('notificaciones-sugerencias.destroy');
    });
});

Route::get('/proveedor/catalogo-productos/{catalogo}', [ProveedorController::class, 'showCatalogoProductos'])->name('proveedor-catalogo-productos.show');
Route::get('/proveedor/producto/{producto}', [ProveedorController::class, 'showProducto'])->name('proveedor-producto.show');
Route::get('/proveedor/perfil/{persona}', [ProveedorController::class, 'showPerfilNegocio'])->name('proveedor-perfil.show');

Route::get('/buscador-mtv/{tipo?}', [BuscadorMTVController::class, 'index'])->name('buscador-mtv.index');
Route::get('/busqueda-items-cards', [BuscadorMTVController::class, 'getItemsCards'])->name('buscador-mtv.items-cards');
Route::post('/buscador-mtv/{tipo}/{keyword?}', [BuscadorMTVController::class, 'search'])->name('buscador-mtv.search');

Route::middleware(['role:urg', 'auth'])->group(function() {
    Route::controller(EntidadURGController::class)->group(function () {
        Route::get('/urg-productos/favoritos', 'indexFavoritos')->name('urg-productos-favoritos.index');
        Route::post('/urg-productos/favoritos/{producto}', 'updateProductoFavoritos')->name('urg-productos-favoritos.update');
        Route::get('/urg-productos/favoritos/export', 'exportProductosFavoritos')->name('urg-productos-favoritos.export');
    });

    Route::controller(UsuariosMensajesController::class)->group(function () {
        Route::post('/urg-mensajes', 'send')->name('urg-mensajes.send');
    });
});

Route::controller(OportunidadesController::class)->group(function() {
    Route::get('/oportunidades-de-negocio', 'search')->name('oportunidades-negocio.search');
    Route::post('/oportunidades-de-negocio', 'search')->name('oportunidades-negocio.search');
    Route::post('/oportunidades-de-negocio/alertas/{oportunidad_negocio}', 
                'updateBookmark')->middleware(['role:proveedor', 'auth'])->name('oportunidades-negocio-bookmarks.update');
    Route::get('/oportunidades-de-negocio/export', 'exportOportunidadesNegocio')->name('oportunidades-negocio.export');
    Route::get('/oportunidades-items-cards', 'getItemsCards')->name('oportunidades.items-cards');
});

Route::controller(CalendarioComprasController::class)->group(function () {
    Route::get('/calendario-compras', 'index')->name('calendario-compras.index');
    Route::get('/compras-procedimientos/export-xls/{unidad_compradora}', 'exportComprasProcedimientosXls')->name('compras-procedimientos.export-xls');
    Route::get('/compras-procedimientos/export-pdf/{unidad_compradora}', 'exportComprasProcedimientosPdf')->name('compras-procedimientos.export-pdf');
});

Route::controller(ComprasDetalleController::class)->group(function () {
    Route::get('/compras-detalle/{unidad_compradora}', 'index')->name('compras-detalle.index');
});

require __DIR__.'/auth.php';
