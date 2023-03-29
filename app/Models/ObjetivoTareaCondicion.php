<?php

namespace App\Models;

enum ObjetivoTareaCondicion: int
{
    case PerfilNegocioCreado = 1;
    case CatalogoNoCreado = 2;
    case CatalogoCreado = 3;
    case OportunidadesBuscadasGuardadas = 4;
    case ObjetivosCumplidos = 5;
}
