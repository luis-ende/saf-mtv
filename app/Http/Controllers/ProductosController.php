<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Producto;

class ProductosController extends Controller
{
    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(Request $request): RedirectResponse
    {
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

        return redirect()->route('catalogo-productos');
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(Request $request, Producto $producto)
    {
        $producto['clave_cabms'] = $request->input('clave_cabms');
        $producto['nombre'] = $request->input('nombre_producto');
        $producto['descripcion'] = $request->input('descripcion_producto');
        $producto['tipo'] = $request->input('tipo_producto');
        $producto['precio'] = $request->input('precio');
        $producto['marca'] = $request->input('modelo');
        $producto['color'] = $request->input('color');
        $producto['material'] = $request->input('material');
        $producto->save();

        return redirect()->route('catalogo-productos');
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Request $request, Producto $producto)
    {
        return view('productos.edit', ['producto' => $producto]);
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function destroy(Request $request)
    {
        // TODO: Implementar eliminado de producto del catálogo
        return redirect()->route('catalogo-productos')->with('success', 'Producto eliminado del catalogo.');
    }
}
