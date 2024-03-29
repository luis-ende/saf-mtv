<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

use App\Imports\ProductosImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductoRequest;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ProductoRepository;
use Illuminate\Support\Facades\Validator;
use App\Services\RegistroProductosService;
use App\Services\RedesSocialesEnlacesService;
use Illuminate\Validation\ValidationException;

class CatalogoProductosController extends Controller
{
     /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request, ProductoRepository $productoRepo)
    {
        $catalogoId = Auth::user()->persona->catalogoProductos->id;
        $productos = $productoRepo->obtieneProductosPorCatalogo($catalogoId);

        $productosBien = $productos->filter(function ($producto) {
            return $producto->tipo === Producto::TIPO_PRODUCTO_BIEN_ID;
        });
        $productosServicio = $productos->filter(function ($producto) {
            return $producto->tipo === Producto::TIPO_PRODUCTO_SERVICIO_ID;
        });        

        $compartir_enlaces = RedesSocialesEnlacesService::generaEnlaces(url()->current(), 'Catálogo Mi Tiendita Virtual');    

        return view('proveedor.catalogo-productos', [
            'productos_bien' => $productosBien,
            'productos_servicio' => $productosServicio,
            'compartir_enlaces' => $compartir_enlaces,
        ]);
    }

    public function showRegistroInicio()
    {
        return view('catalogo-productos.inicio-tipo-carga');
    }

    public function showAltaProducto1(?Producto $producto)
    {
        if ($producto && $producto->registro_fase >= RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS) {
            return redirect()->route('catalogo-registro-inicio')->with('error', 'El producto ya ha completado su proceso de registro previamente.');
        }

        return view('catalogo-productos.alta-producto-1', ['producto' => $producto]);
    }
    public function showAltaProducto2(Request $request, Producto $producto)
    {
        if ($producto->registro_fase >= RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS) {
            return redirect()->route('catalogo-registro-inicio')->with('error', 'El producto ya ha completado su proceso de registro previamente.');
        }

        return view('catalogo-productos.alta-producto-2', ['producto' => $producto]);
    }
    public function showAltaProducto3(Request $request, Producto $producto)
    {
        if ($producto->registro_fase >= RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS) {
            return redirect()->route('catalogo-registro-inicio')->with('error', 'El producto ya ha completado su proceso de registro previamente.');
        }

        return view('catalogo-productos.alta-producto-3', ['producto' => $producto]);
    }
    public function showAltaProducto4(Request $request, Producto $producto)
    {
        if ($producto->registro_fase >= RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS) {
            return redirect()->route('catalogo-registro-inicio')->with('error', 'El producto ya ha completado su proceso de registro previamente.');
        }

        return view('catalogo-productos.alta-producto-4', ['producto' => $producto]);
    }

    public function storeAltaProducto(Request $request, int $registroFase, ?Producto $producto = null)
    {
        $catalogoId = Auth::user()->persona->catalogoProductos->id;

        if ($producto && $producto->registro_fase >= 4) {
            return redirect()->route('catalogo-registro-inicio')->with('error', 'El producto ya ha completado su proceso de registro previamente.');
        }

        try {
            switch($registroFase) {
                case RegistroProductosService::ALTA_PRODUCTO_FASE_CABMS_CATEGORIAS:
                    $this->validate($request, [
                        ...ProductoRequest::rulesProductoTipo(),
                        ...ProductoRequest::rulesProductoCABMSCategorias(),
                    ]);
                    break;
                case RegistroProductosService::ALTA_PRODUCTO_FASE_DESCRIPCION:
                    $this->validate($request, ProductoRequest::rulesProductoDescripcion());
                    break;
                case RegistroProductosService::ALTA_PRODUCTO_FASE_FOTOS:
                    $this->validate($request, ProductoRequest::rulesProductoFotos());
                    break;
                case RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS:
                    $this->validate($request, ProductoRequest::rulesProductoAdjuntos());
                    break;
            }

        } catch(ValidationException $e) {
            return redirect()->back()
                             ->withErrors($e->validator)
                             ->withInput();
        }

        switch($registroFase) {
            case RegistroProductosService::ALTA_PRODUCTO_FASE_CABMS_CATEGORIAS:
                if ($producto) {
                    $producto->update($request->only('tipo', 'id_cabms'));
                }
                else {
                    $producto = Producto::create([
                        'id_cat_productos' => $catalogoId,
                        'tipo' => $request->input('tipo_producto'),
                        'id_cabms' => $request->input('id_cabms'),
                        'nombre' => '[En proceso de registro]',
                        'descripcion' => '[En proceso de registro]',
                        'registro_fase' => $registroFase,
                    ]);
                }

                $producto->actualizaCategoriasScian($request->input('ids_categorias_scian'));

                return redirect()->route('alta-producto-2.show', [$producto]);
            case RegistroProductosService::ALTA_PRODUCTO_FASE_DESCRIPCION:
                $productoData = $request->only('nombre', 'descripcion', 'marca', 'modelo',
                                                    'material', 'codigo_barras');
                if ($request->has('producto_colores')) {
                    $productoData['color'] = $producto->obtieneColoresValue($request->input('producto_colores'));
                }
                $productoData['registro_fase'] = $registroFase;
                $producto->update($productoData);

                return redirect()->route('alta-producto-3.show', [$producto]);
            case RegistroProductosService::ALTA_PRODUCTO_FASE_FOTOS:
                $producto->actualizaFotos($request->file('producto_fotos'),
                                      $request->input('producto_fotos_eliminadas'));

                $producto->update(['registro_fase' => $registroFase]);

                return redirect()->route('alta-producto-4.show', [$producto]);
            case RegistroProductosService::ALTA_PRODUCTO_FASE_ADJUNTOS:
                $documentos = $request->only('ficha_tecnica_file', 'otro_documento_file');
                if (array_key_exists('ficha_tecnica_file', $documentos)) {
                    $producto->addMedia($documentos['ficha_tecnica_file'])->toMediaCollection('fichas_tecnicas');
                }
                if (array_key_exists('otro_documento_file', $documentos)) {
                    $producto->addMedia($documentos['otro_documento_file'])->toMediaCollection('otros_documentos');
                }

                $producto->update(['registro_fase' => $registroFase]);

                return redirect()->route('catalogo-registro-inicio')->with('success', 'Un nuevo producto ha sido agregado a tu catálogo.');
        }
    }

    public function showImportacionProductos1(Request $request)
    {
        $catalogoProductos = $request->user()->persona->catalogoProductos;
        if ($catalogoProductos->carga_masiva_completa === true) {
            return redirect()->route('catalogo-registro-inicio')->with('warning', 'La carga masiva se permite sólo una vez.');
        }

        return view('catalogo-productos.importacion-productos-1');
    }

    public function showImportacionProductos2(Request $request)
    {
        $catalogoProductos = $request->user()->persona->catalogoProductos;
        if ($catalogoProductos->carga_masiva_completa === true) {
            return redirect()->route('catalogo-registro-inicio')->with('warning', 'La carga masiva se permite sólo una vez.');
        }

        $productosRechazados = session()->get('productos_rechazados') ?? 0;
        $rows = session()->get('rows') ?? [];

        return view('catalogo-productos.importacion-productos-2', [
            'productos_rechazados' => $productosRechazados,
            'rows' => $rows,
        ]);
    }

    public function showImportacionProductos3(Request $request, ProductoRepository $productoRepo)
    {
        $catalogoProductos = $request->user()->persona->catalogoProductos;
        if ($catalogoProductos->carga_masiva_completa === true) {
            return redirect()->route('catalogo-registro-inicio')->with('warning', 'La carga masiva se permite sólo una vez.');
        }

        $productosImportados = $productoRepo->obtieneProductosImportados($catalogoProductos->id);
        $productos = array_map(function ($producto) use($productoRepo) {
            $productoCABMSCategorias = $productoRepo->obtieneProductoCABMSCategorias($producto['id']);

            return array_merge($producto, $productoCABMSCategorias);
        }, $productosImportados);

        return view('catalogo-productos.importacion-productos-3', [
            'productos' => $productos,
        ]);
    }

    public function storeCargaProductos(Request $request, int $cargaFase)
    {
        $catalogoProductos = $request->user()->persona->catalogoProductos;

        try {
            $catalogoId = $catalogoProductos->id;

            switch($cargaFase) {
                case RegistroProductosService::IMPORTACION_FASE_CARGA_EXCEL:
                    $this->validate($request, [
                        'productos_import_file' => 'required|file|max:1000|mimes:xlsx',
                    ]);

                    // Permitir carga de archivo mientras no se haya concluido el proceso de importación
                    $catalogoProductos->clearMediaCollection('importaciones');

                    // Se guarda temporalmente el archivo de importación, eliminar archivo al completar la carga de productos.
                    $archivoImportacion = $request->file('productos_import_file');
                    $media = $catalogoProductos->addMedia($archivoImportacion)->toMediaCollection('importaciones');
                    $archivoImportacionPath = $media->getPath();

                    $productosImport = new ProductosImport($catalogoId);

                    $plantillaPath = Storage::path(config('mtv.plantilla_productos_carga_masiva'));

                    $plantillaRows = Excel::toArray($productosImport, $plantillaPath);

                    $rows = Excel::toArray($productosImport, $archivoImportacionPath);

                    $plantillaColumnas = array_keys($plantillaRows[0][0]);
                    $importacionColumnas = array_keys($rows[0][0]);

                    $diferencias = array_diff($plantillaColumnas, $importacionColumnas);
                    if (count($diferencias) > 0) {
                        throw new \Exception('Las columnas del archivo a cargar no coinciden con las de la plantilla.');
                    }

                    $contadorErrores = 0;
                    $rowsPreviews = array_map(function($row) use(&$contadorErrores, $productosImport) {
                        $errores = [];

                        $validator = Validator::make($row, $productosImport->rules());

                        if  ($validator->fails()) {
                            $errores = $validator->errors()->all();
                        }

                        for($i = 1; $i <= 3; $i++) {
                            $fotoURLColumn = 'foto_url_' . $i;
                            $fotoURL = $row[$fotoURLColumn];
                            if (!$validator->errors()->get($fotoURLColumn) && !empty($fotoURL) ) {
                                $response = Http::get($row[$fotoURLColumn]);
                                if ($response->status() !== 200) {
                                    $errores[] = "Columna 'foto_url_" . $i ."'" . " no contiene una URL válida o es inaccesible.";
                                }
                            }
                        }

                        if ($errores) {
                            $contadorErrores++;
                        }

                        $rowPreview = [
                            ...$row,
                            'errores' => count($errores) > 0 ? $errores : null,
                        ];

                        return $rowPreview;
                    }, $rows[0]);

                    return redirect()->route('importacion-productos-2.show')->with([
                        'productos_rechazados' => $contadorErrores,
                        'rows' => $rowsPreviews,
                    ]);
                case RegistroProductosService::IMPORTACION_FASE_VISTA_PREVIA:
                    $archivoImportacionPath = $catalogoProductos->getFirstMedia('importaciones');
                    if ($archivoImportacionPath) {
                        $archivoImportacionPath = $archivoImportacionPath->getPath();
                        Excel::import(new ProductosImport($catalogoId), $archivoImportacionPath);
                        $productos = $catalogoProductos->productos;
                        foreach ($productos as $producto) {
                            if (!empty($producto->foto_url_1)) {
                                $producto->addMediaFromUrl($producto->foto_url_1)->toMediaCollection('fotos');
                            }
                            if (!empty($producto->foto_url_2)) {
                                $producto->addMediaFromUrl($producto->foto_url_2)->toMediaCollection('fotos');
                            }
                            if (!empty($producto->foto_url_3)) {
                                $producto->addMediaFromUrl($producto->foto_url_3)->toMediaCollection('fotos');
                            }
                        }

                        return redirect()->route('importacion-productos-3.show');
                    }
                    break;
                case RegistroProductosService::IMPORTACION_FASE_PRODUCTOS_IMPORTADOS:
                    $catalogoProductos->update(['carga_masiva_completa' => true]);
                    $catalogoProductos->clearMediaCollection('importaciones');

                    return redirect()->route('catalogo-registro-inicio')->with('success', 'Carga masiva de productos finalizada.');
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator);
        } catch(\Throwable $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al cargar los productos: ' . $e->getMessage());
        }
    }

    public function storeCargaProductosProducto(Request $request, Producto $producto, ProductoRepository $productoRepo)
    {
        try {
            $this->validate($request, [
                'id_cabms' => 'integer',
                'ids_categorias_scian' => 'required|array',
                'ids_categorias_scian.*' => 'integer',
                'producto_fotos' => 'max:3',
                'producto_fotos.*' => 'max:1000|mimes:jpg,png',
                'producto_fotos_eliminadas' => 'nullable|string',
            ]);
        } catch (ValidationException $e) {
            return [$e->validator];
        }

        $productoDatos = $request->only('id_cabms');
        // Al asignar cabms y categorías se completa el registro del producto
        $productoDatos['registro_fase'] = 4;
        $producto->update($productoDatos);

        $producto->actualizaCategoriasScian($request->input('ids_categorias_scian'));

        $producto->actualizaFotos($request->file('producto_fotos'),
                                  $request->input('producto_fotos_eliminadas'));

        return $productoRepo->obtieneProductoCABMSCategorias($producto->id);
    }
}
