<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Producto;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductosController extends Controller
{
    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'clave_cabms' => 'required',
            'nombre_producto' => 'required',
            'descripcion_producto' => 'required',
            'precio' => 'required'
        ]);

        Producto::create([
            'id_cat_productos' => Auth::user()->persona->catalogoProductos->id,
            'clave_cabms' => $request->input('clave_cabms'),
            'nombre' => $request->input('nombre_producto'),
            'descripcion' => $request->input('descripcion_producto'),
            'tipo' => $request->input('tipo_producto'),
            'precio' => $request->input('precio'),
            'marca' => $request->input('modelo'),
            'color' => $request->input('color'),
            'material' => $request->input('material'),
        ]);

        return redirect()->route('catalogo-productos')
            ->with('success', 'Nuevo producto agregado al catálogo de productos.');
    }

    public function update(Request $request, Producto $producto)
    {
        // TODO: Crear validador para reutilizar 
        $request->validate([
            'clave_cabms' => 'required',
            'nombre_producto' => 'required',
            'descripcion_producto' => 'required',
            'precio' => 'required'
        ]);

        $producto['clave_cabms'] = $request->input('clave_cabms');
        $producto['nombre'] = $request->input('nombre_producto');
        $producto['descripcion'] = $request->input('descripcion_producto');
        $producto['tipo'] = $request->input('tipo_producto');
        $producto['precio'] = $request->input('precio');
        $producto['marca'] = $request->input('modelo');
        $producto['color'] = $request->input('color');
        $producto['material'] = $request->input('material');
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
        $rules = [
            'map_clave_cabms' => 'required', 
            'map_nombre' => 'required', 
            'map_descripcion' => 'required', 
            'map_precio' => 'required',
            'productos_archivo' => 'required',
        ];

        $archivoImportacionPath = '';
        if ($this->validate($request, $rules)) {
            $opciones = $request->only(['map_clave_cabms', 'map_nombre', 'map_descripcion', 'map_precio',]);
            $archivoImportacion = $request->file('productos_archivo');
            $archivoImportacionPath = $archivoImportacion->store('public/producto_importaciones');
    
            (new (ProductosImportadorService))->importarProductos($archivoImportacionPath, $opciones);
        }
        
        $all = array_keys($request->all()); // TODO: TEST
        $all['import_path'] = $archivoImportacionPath;

        return [$all];
    }
}
