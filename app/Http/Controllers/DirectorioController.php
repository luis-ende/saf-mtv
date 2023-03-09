<?php

namespace App\Http\Controllers;

use App\Repositories\FuncionarioRepository;
use Illuminate\Http\Request;

class DirectorioController extends Controller
{
    public function index(Request $request, FuncionarioRepository $funcionarioRepo)
    {
        $funcionarios = $funcionarioRepo->obtieneFuncionarios();

        return view('directorio.index', compact('funcionarios'));
    }
}
