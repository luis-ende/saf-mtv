<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Repositories\ProductoRepository;
use Illuminate\Http\Request;
use Maize\Markable\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class EntidadURGController extends Controller
{
    public function indexFavoritos(Request $request, ProductoRepository $productoRepo)
    {
        $user = Auth::user();
        $productos = $productoRepo->obtieneProductosFavoritos($user);

        return view('entidad-urg.favoritos-index', compact('productos'));
    }

    public function updateProductoFavoritos(Request $request, Producto $producto)
    {
        $user = Auth::user();
        Favorite::toggle($producto, $user);
        $num_favoritos = Favorite::count($producto);

        return compact('num_favoritos');
    }
}