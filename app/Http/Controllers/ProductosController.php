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
    public function update(Request $request, Producto $producto, ProductoRepository $productoRepo)
    {
        $rulesAdjuntos = ProductoRequest::rulesProductoAdjuntos();
        $requiredRule = array_search('required', $rulesAdjuntos['ficha_tecnica_file']);
        unset($rulesAdjuntos['ficha_tecnica_file'][$requiredRule]);
        $rulesFotos = ProductoRequest::rulesProductoFotos();
        unset($rulesFotos['producto_fotos']);
        try {
            $this->validate($request, [
                ...ProductoRequest::rulesProductoCABMSCategorias(),
                ...ProductoRequest::rulesProductoDescripcion(),
                ...$rulesFotos,
                ...$rulesAdjuntos,
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator);
        }

        $productoData = $request->only('id_cabms', 'nombre', 'descripcion', 'marca',
                                            'modelo', 'material', 'codigo_barras');
        if ($request->has('producto_colores')) {
            $productoData['color'] = $producto->obtieneColoresValue($request->input('producto_colores'));
        }

        $productoRepo->actualizaProducto(
            $producto,
            $productoData,
            $request->input('ids_categorias_scian'),
            $request->only('producto_fotos','producto_fotos_eliminadas'),
            $request->only('ficha_tecnica_file', 'otro_documento_file', 'eliminar_ficha_tecnica', 'eliminar_otro_documento')
        );

        return redirect()->route('productos.show', [$producto->id])->with('success', 'Producto modificado.');
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
        return $producto->getMedia('fotos')->toArray();
    }

    public function obtieneProductoCABMSCategorias(Request $request, Producto $producto, ProductoRepository $productoRepo) {
        return $productoRepo->obtieneProductoCABMSCategorias($producto->id);
    }
}
