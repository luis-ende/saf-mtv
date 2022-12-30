<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use App\Imports\ProductosImport;
use App\Models\CatalogoProductos;
use App\Models\ProductoCategoria;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CatalogoProductosController extends Controller
{
     /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $productosPersona = Auth::user()->persona->catalogoProductos->productos;

        return view('catalogo-productos', [
            'productosPersona' => $productosPersona,
        ]);
    }

    public function showRegistroInicio()
    {
        return view('catalogo-productos.inicio-tipo-carga');
    }

    public function showAltaProducto1()
    {
        return view('catalogo-productos.alta-producto-1');
    }
    public function showAltaProducto2()
    {
        return view('catalogo-productos.alta-producto-2');
    }
    public function showAltaProducto3()
    {
        return view('catalogo-productos.alta-producto-3');
    }
    public function showAltaProducto4()
    {
        return view('catalogo-productos.alta-producto-4');
    }

    public function storeAltaProducto(Request $request, int $registroFase, ?Producto $producto)
    {
        $catalogoId = Auth::user()->persona->catalogoProductos->id;

        if ($registroFase > 1 && is_null($producto)) {
            return redirect()->back()->with('error', 'Alta de producto inválido.');
        }

        if ($producto && $producto->registro_fase > 4) {
            // TODO: Validar si la fase de registro coincide con la fase de registro en el producto...
            return redirect()->back()->with('error', 'El producto ya ha completado su proceso de registro previamente.');
        }

        try {
            if ($registroFase === 1) {
                // $rules = ProductoRequest::PRODUCTO_REQUEST_RULES
                $this->validate($request, [
                    'tipo_producto' => [
                        'required',
                        Rule::in([
                            Producto::TIPO_PRODUCTO_BIEN_ID,
                            Producto::TIPO_PRODUCTO_SERVICIO_ID])
                        ],
                    'ids_categorias_scian' => 'required|json',
                ]);
            }

            if ($registroFase === 2) {
                $this->validate($request, [
                    'nombre' => 'required|max:255',
                    'descripcion' => 'required|max:140',
                    'marca' => 'max:255',
                    'modelo' => 'max:255',
                    'color' => 'max:30',
                    'material' => 'max:255',
                    'codigo_barras' => 'max:100',
                ]);
            }

            if ($registroFase === 3) {
                $this->validate($request, [
                    'producto_fotos' => 'required|max:3',
                    'producto_fotos.*' => 'max:1000|mimes:jpg,png'
                ]);
            }

            if ($registroFase === 4) {
                $this->validate($request, [
                    'ficha_tecnica_file' => 'required|max:3000|mimes:pdf',
                    'otro_documento_file' => 'max:3000|mimes:pdf',
                ]);
            }

        } catch(ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }

        if ($registroFase === 1) {
            // TODO: Abrir db transaction
            $productoNuevo = Producto::create([
                'id_cat_productos' => $catalogoId,
                'tipo' => $request->input('tipo_producto'),
                'nombre' => '[En proceso de registro]',
                'descripcion' => '[En proceso de registro]',
                'registro_fase' => $registroFase,
            ]);

            $categorias = json_decode($request->input('ids_categorias_scian'), true);
            foreach($categorias as $categoriaId) {
                ProductoCategoria::create([
                    'id_producto' => $productoNuevo->id,
                    'id_categoria_scian' => $categoriaId,
                ]);
            }

            return redirect()->route('alta-producto-2.show', [$productoNuevo->id]);
        } elseif ($registroFase === 2) {
            $productoData = $request->only('nombre', 'descripcion', 'marca', 'modelo',
                                            'color', 'material', 'codigo_barras');
            $productoData['registro_fase'] = $registroFase;
            $producto->update($productoData);

            return redirect()->route('alta-producto-3.show', [$producto]);
        } elseif ($registroFase === 3) {
            $fotosFiles = $request->file('producto_fotos');
            $producto->clearMediaCollection('fotos');
            foreach($fotosFiles as $file) {
                $producto->addMedia($file)->toMediaCollection('fotos');
            }
            $producto->update(['registro_fase' => $registroFase]);

            return redirect()->route('alta-producto-4.show', [$producto]);
        } elseif ($registroFase === 4) {
            $documentos = $request->only('ficha_tecnica_file', 'otro_documento_file');
            foreach ($documentos as $documento) {
                $producto->addMedia($documento)->toMediaCollection('documentos');
            }

            $producto->update(['registro_fase' => $registroFase]);

            return redirect()->route('catalogo-registro-inicio')->with('success', 'Un nuevo producto ha sido agregado a tu catálogo.');
        }

        // return redirect()->route('alta-producto-2.show');
    }

    public function showImportacionProductos1()
    {
        return view('catalogo-productos.importacion-productos-1');
    }

    public function showImportacionProductos2()
    {
        return view('catalogo-productos.importacion-productos-2');
    }

    public function showImportacionProductos3()
    {
        return view('catalogo-productos.importacion-productos-3');
    }

    public function storeCargaProductos(Request $request, int $cargaFase)
    {
        // TODO: Evitar carga masiva si el catálogo ya fue cargado anteriormente

        $catalogoProductos = $request->user()->persona->catalogoProductos;

        try {
            $opciones['carga_fase'] = $cargaFase;
            $catalogoId = $catalogoProductos->id;

            if ($cargaFase === 1) {
                $this->validate($request, [
                    /*'productos_import_file' => 'required|file|mimes:xlsx,csv|max:1000',*/
                    'productos_import_file' => 'required|file|max:1000',
                ]);

                // Permitir carga de archivo mientras no se haya concluido el proceso de importación        
                $catalogoProductos->clearMediaCollection('importaciones');                        

                // Se guarda temporalmente el archivo de importación, eliminar archivo al completar la carga de productos.        
                $archivoImportacion = $request->file('productos_import_file');
                $media = $catalogoProductos->addMedia($archivoImportacion)->toMediaCollection('importaciones');
                $archivoImportacionPath = $media->getPath();                

                $plantillaPath = Storage::path('public/plantillas/productos_carga_masiva.xlsx');            
                $plantillaRows = Excel::toArray(new ProductosImport($catalogoId, $opciones), $plantillaPath);            
                
                $rows = Excel::toArray(new ProductosImport($catalogoId, $opciones), $archivoImportacionPath);
                
                $plantillaColumnas = array_keys($plantillaRows[0][0]);
                $importacionColumnas = array_keys($rows[0][0]);
    
                $diferencias = array_diff($plantillaColumnas, $importacionColumnas);            
                if (count($diferencias) > 0) {
                    throw new \Exception('Las columnas del archivo a cargar no coinciden con las de la plantilla.');
                }
                
                $contadorErrores = 0;
                $rowsPreviews = array_map(function($row) use(&$contadorErrores) {
                    $errores = [];
                    if (empty($row['tipo'])) {
                        $errores[] = "Columna 'tipo' no contiene información.";
                    }
    
                    if (empty($row['producto'])) {
                        $errores[] = "Columna 'producto' no contiene información."; 
                    }
                    
                    if (empty($row['descripcion'])) {
                        $errores[] = "Columna 'descripcion' no contiene información.";
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
    
                return view('catalogo-productos.importacion-productos-2', [
                    'productos_rechazados' => $contadorErrores,
                    'rows' => $rowsPreviews,
                ]);
            } elseif ($cargaFase === 2) {
                $archivoImportacionPath = $catalogoProductos->getMedia('importaciones');
                if ($archivoImportacionPath) {
                    Excel::import(new ProductosImport($catalogoId, $opciones), $archivoImportacionPath);
                }
            }
            
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator);
        } catch(\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
