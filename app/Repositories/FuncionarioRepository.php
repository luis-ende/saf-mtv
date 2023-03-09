<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FuncionarioRepository
{
    public function obtieneFuncionarios(): array
    {
        return DB::table('funcionarios')
                ->select('funcionarios.id', 'funcionarios.nombre', 'funcionarios.puesto',
                         'funcionarios.funciones', 'funcionarios.telefono_oficina',
                         'funcionarios.email',
                         'funcionarios.id_unidad_compradora', 'cuc.nombre AS unidad_compradora')
                ->join('cat_unidades_compradoras AS cuc', 'cuc.id', '=', 'id_unidad_compradora')
                ->orderBy('unidad_compradora')
                ->orderBy('funcionarios.nombre')
                ->get()
                ->toArray();
    }
}