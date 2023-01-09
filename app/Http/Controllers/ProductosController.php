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
    public function update(ProductoRequest $request, Producto $producto)
    {
        // TODO: Implementar junto con la vista de formulario de edición de producto

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
        if ($producto->catalogo->persona->id === Auth::user()->id_persona) {
            $producto->clearMediaCollection('fotos');
            $producto->clearMediaCollection('documentos');
            $producto->delete();
            
            return [$producto->id];
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
