<?php

namespace App\Models;

enum EtapaProcedimiento: string
{
    case CompraProgramada = 'Compra programada';
    case Precotizacion = 'Precotizaciones';
    case Prebase = 'Prebases';
    case LicitacionEnProceso = 'Licitaciones en proceso';
}
