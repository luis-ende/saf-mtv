<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use App\Models\CatalogoProductos;
use Illuminate\Support\Facades\Auth;
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
                    'id_cabms' => 'required|integer',
                    'tipo_producto' => [
                        'required', 
                        Rule::in([
                            Producto::TIPO_PRODUCTO_BIEN_ID, 
                            Producto::TIPO_PRODUCTO_SERVICIO_ID])
                        ],
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
                    'producto_fotos.*' => 'required|max:3000'
                ]);    
            }

        } catch(ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }
            
        if ($registroFase === 1) {
            $productoNuevo = Producto::create([
                'id_cat_productos' => $catalogoId,
                'tipo' => $request->input('tipo_producto'),
                'id_cabms' => $request->input('id_cabms'),
                'nombre' => '[En proceso de registro]',
                'descripcion' => '[En proceso de registro]',
                'registro_fase' => $registroFase,
            ]);

            return redirect()->route('alta-producto-2.show', [$productoNuevo->id]);
        } elseif ($registroFase === 2) {
            $productoData = $request->only('nombre', 'descripcion', 'marca', 'modelo', 
                                            'color', 'material', 'codigo_barras');
            $producto->update($productoData);

            return redirect()->route('alta-producto-3.show', [$producto]);
        } elseif ($registroFase === 3) {
            $producto->addMedia($request->file['producto_fotos'])->toMediaCollection('fotos');
            $producto->update(['registro_fase' => $registroFase]);
            

            return redirect()->route('alta-producto-4.show', [$producto]);
        } elseif ($registroFase === 4) {            
            $producto->update(['registro_fase' => $registroFase]);
            
            return redirect()->route('catalogo-registro-inicio');
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
}
