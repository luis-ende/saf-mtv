<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Producto;
use App\Imports\ProductosImport;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProductoRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductosController extends Controller
{
    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(ProductoRequest $request): RedirectResponse
    {
        $productoFields = $request->validated();
        Producto::create([
            'id_cat_productos' => Auth::user()->persona->catalogoProductos->id,
            'clave_cabms' => $productoFields['clave_cabms'],
            'nombre' => $productoFields['nombre_producto'],
            'descripcion' => $productoFields['descripcion_producto'],
            'tipo' => $productoFields['tipo_producto'],
            'precio' => $productoFields['precio'],
            'marca' => $productoFields['marca'],
            'modelo' => $productoFields['modelo'],
            'color' => $productoFields['color'],
            'material' => $productoFields['material'],
        ]);

        return redirect()->route('catalogo-productos')
            ->with('success', 'Nuevo producto agregado al catálogo de productos.');
    }

    public function update(ProductoRequest $request, Producto $producto)
    {
        $productoFields = $request->validated();
        $producto['clave_cabms'] = $productoFields['clave_cabms'];
        $producto['nombre'] = $productoFields['nombre_producto'];
        $producto['descripcion'] = $productoFields['descripcion_producto'];
        $producto['tipo'] = $productoFields['tipo_producto'];
        $producto['precio'] = $productoFields['precio'];
        $producto['marca'] = $productoFields['marca'];
        $producto['modelo'] = $productoFields['modelo'];
        $producto['color'] = $productoFields['color'];
        $producto['material'] = $productoFields['material'];
        $producto->save();

        return redirect()->route('catalogo-productos')
            ->with('success', 'Producto actualizado.');
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Request $request, Producto $producto)
    {
        return view('productos.edit', ['producto' => $producto]);
    }

    public function destroy(Request $request, Producto $producto)
    {
        if ($producto) {
            if ($producto->catalogo->persona->id === Auth::user()->id_persona) {
                $producto->delete();

                return redirect()->route('catalogo-productos')->with('success', 'Producto eliminado del catalogo.');
            } else {
                return redirect()->route('catalogo-productos')->with('error', 'No es posible eliminar el producto.');
            }
        }


        return redirect()->route('catalogo-productos');
    }

    public function storeFiles(Request $request, Producto $producto) {
        if ($request->file('producto_archivos') && $this->validate($request, ['producto_archivos' => 'required'])) {
            $productoArchivos = $request->file('producto_archivos');
            // TODO: Validar si el archivo ya existe
            foreach ($productoArchivos as $file) {
                $extension = $file->getClientOriginalExtension();
                $path = $file->store('public/producto_archivos');
                $collectionName = 'archivos';
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $collectionName = 'fotos';
                }
                $mediaItem = $producto->addMedia(storage_path('app') . '/' . $path)->toMediaCollection($collectionName);
                $mediaItem->name = $file->getClientOriginalName();
                $mediaItem->save();
            }
        }

        return [true];
    }

    public function deleteFile(Request $request, int $id) {
        /** @var Media $file */
        $file = Media::find($id);
        if ($file) {
            $producto = Producto::find($file->model_id);
            if ($producto && $producto->catalogo->persona->id === Auth::user()->id_persona) {
                $file->delete();

                return response('OK Deleted', 200);
            }
        }

        return response('Delete failed', 404);
    }

    public function showArchivos(Request $request, Producto $producto) {
        return $producto->getAllMedia();
    }

    public function importProductos(Request $request) {        
        if (!Auth::user()) {
            return response()
                ->json(['error' => 'Importación de productos disponible únicamente para usuarios registrados.'], 401);
        }

        $catalogoId = Auth::user()->persona->catalogoProductos->id;
        $rules = [
            'map_clave_cabms' => 'required',
            'map_nombre' => 'required',
            'map_descripcion' => 'required',
            'map_precio' => 'required',
            'productos_archivo' => 'required',
            'map_tipo_producto' => ['required', Rule::in([                
                    Producto::TIPO_PRODUCTO_BIEN_ID, 
                    Producto::TIPO_PRODUCTO_SERVICIO_ID,                
                ])],
        ];

        try {
            if ($this->validate($request, $rules)) {
                $opciones = $request->only([
                    'map_clave_cabms',
                    'map_nombre',
                    'map_descripcion',
                    'map_precio',
                    'map_tipo_producto',
                ]);
                $archivoImportacion = $request->file('productos_archivo');
                $archivoImportacionPath = $archivoImportacion->store('public/producto_importaciones');

                Excel::import(new ProductosImport($catalogoId, $opciones), $archivoImportacionPath);

                return response()
                    ->json(['message' => 'Productos importados.'], 201);
            }
        } catch (\Throwable $e) {
            return response()
                ->json(['error' => $e->getMessage()], 500);
        }

        return response()
            ->json(['error' => 'Ocurrió un error al importar los productos.'], 500);
    }
}
