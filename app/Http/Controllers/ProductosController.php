<?php

namespace App\Http\Controllers;

use App\Repositories\ProductoRepository;
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
                $producto->clearMediaCollection('fotos');
                $producto->clearMediaCollection('documentos');
                $producto->delete();

                // TODO: Eliminar fotos y archivos
                return [$producto->id];
            }
        }
    }    

    public function showFotos(Request $request, Producto $producto) {
        // TODO Validar que el producto pertenezca al catálogo del usuario

        return $producto->getMedia('fotos')->toArray();
    }

    public function obtieneProductoCABMSCategorias(Request $request, Producto $producto, ProductoRepository $productoRepo) {
        return $productoRepo->obtieneProductoCABMSCategorias($producto->id);
    }    
}
