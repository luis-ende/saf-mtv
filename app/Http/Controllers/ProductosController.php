<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ProductoRequest;
use App\Repositories\ProductoRepository;
use Illuminate\Validation\ValidationException;

class ProductosController extends Controller
{    
    public function update(Request $request, Producto $producto)
    {
        // TODO Producto debe pertenecer al catálogo del usuario

        try {
            $this->validate($request, [
                ...ProductoRequest::rulesProductoCABMSCategorias(),
                ...ProductoRequest::rulesProductoDescripcion(),
                ...ProductoRequest::rulesProductoFotos(),
                ...ProductoRequest::rulesProductoAdjuntos(),
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }

        if ($producto) {
            $producto->update($request->only('id_cabms'));
            $producto->actualizaCategoriasScian($request->input('ids_categorias_scian'));            
        }

        return [true];        
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Request $request, int $productoId, ProductoRepository $productoRepo)
    {
        $productoInfo = $productoRepo->obtieneProductoInfo($productoId);
        $productoInfo['fotos_info'] = $productoInfo->getMedia('fotos');
        $productoInfo['ficha_tecnica'] = $productoInfo->getFirstMedia('fichas_tecnicas');
        $productoInfo['otro_documento'] = $productoInfo->getFirstMedia('otros_documentos');

        return view('productos.views.view-proveedor', ['producto' => $productoInfo]);
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
