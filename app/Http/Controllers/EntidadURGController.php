<?php

namespace App\Http\Controllers;

use App\Exports\ProductosFavoritosExport;
use App\Models\Producto;
use App\Repositories\ProductoRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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

    public function exportProductosFavoritos()
    {
        $user = Auth::user();

        return Excel::download(new ProductosFavoritosExport($user),
                      'mtv-productos-favoritos.xlsx',
                    \Maatwebsite\Excel\Excel::XLSX);
    }
}