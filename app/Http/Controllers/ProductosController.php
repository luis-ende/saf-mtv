<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Producto;

class ProductosController extends Controller
{
    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function store(Request $request)
    {
        Producto::create([
            'id_cat_productos' => Auth::user()->persona->catalogoProductos->id,
            'clave_cabms' => $request->input('clave_cabms'),
            'nombre' => $request->input('nombre_producto'),
            'descripcion' => $request->input('descripcion_producto'),
            'tipo' => $request->input('tipo_producto'),
            'categoria' => $request->input('categoria_producto'),
            'subcategoria' => $request->input('subcategoria_producto'),
            'marca' => $request->input('marca'),
        ]);

        return redirect()->route('catalogo-productos');
    }

    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function update(Request $request, Producto $producto)
    {
        Producto::create([
            'id_cat_productos' => Auth::user()->persona->catalogoProductos->id,
            'clave_cabms' => $request->input('clave_cabms'),
            'nombre' => $request->input('nombre_producto'),
            'descripcion' => $request->input('descripcion_producto'),
            'tipo' => $request->input('tipo_producto'),
            'categoria' => $request->input('categoria_producto'),
            'subcategoria' => $request->input('subcategoria_producto'),
            'marca' => $request->input('marca'),
        ]);

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
