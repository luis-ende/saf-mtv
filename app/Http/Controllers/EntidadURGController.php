<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Maize\Markable\Models\Favorite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EntidadURGController extends Controller
{
    public function indexFavoritos(Request $request)
    {
        return view('entidad-urg.favoritos-index');
    }

    public function updateProductoFavoritos(Request $request, Producto $producto)
    {
        $user = Auth::user();
        Favorite::toggle($producto, $user);
        $num_favoritos = Favorite::count($producto);

        return compact('num_favoritos');
    }
}