<?php declare(strict_types = 1);

namespace App\Services;

class RegistroProductosService
{
    public const ALTA_PRODUCTO_FASE_CABMS_CATEGORIAS = 1;
    public const ALTA_PRODUCTO_FASE_DESCRIPCION = 2;
    public const ALTA_PRODUCTO_FASE_FOTOS = 3;
    public const ALTA_PRODUCTO_FASE_ADJUNTOS = 4;

    public const IMPORTACION_FASE_CARGA_EXCEL = 1;
    public const IMPORTACION_FASE_VISTA_PREVIA = 2;
    public const IMPORTACION_FASE_PRODUCTOS_IMPORTADOS = 3;
}
