<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreguntaFrecuente extends Model
{
    use HasFactory;

    public const CATEGORIA_PUBLICO = 1;
    public const SUBCATEGORIA_PUBLICO_CONCEPTOS = 1;
    public const SUBCATEGORIA_PUBLICO_COMPRAS = 2;
    public const SUBCATEGORIA_PUBLICO_MTV = 3;
    public const CATEGORIA_PROVEEDORES = 2;
    public const SUBCATEGORIA_PROVEEDORES_PADRON = 1;
    public const SUBCATEGORIA_PROVEEDORES_PRECOTIZACIONES = 2;
    public const CATEGORIA_INSTITUCIONES = 3;
    public const SUBCATEGORIA_INSTITUCIONES_PAAPS = 1;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'preguntas_frecuentes';
}
