<?php declare(strict_types = 1);

namespace App\Services;

class PadronProveedoresService
{
    public const ETAPAS_PADRON_PROVEEDORES = [
        1 => "SPRO", //	"SOLICITUD EN PROCESO"
        2 => "REV",	// "TRÁMITE EN REVISIÓN"
        3 => "VAL",	// "TRÁMITE EN VALIDACIÓN"
        4 => "SUP",	// "TRÁMITE EN SUPERVISIÓN"
        5 => "AUT",	// "TRÁMITE EN AUTORIZACIÓN"
        6 => "RECH", // "RECHAZADO CON OBSERVACIONES POR SUBSANAR"
        7 => "CONC", // "TRÁMITE CONCLUIDO"
        10 => "SVEN", // "SOLICITUD VENCIDA"
        12 => "RVEN", // "RECHAZADO CON SOLICITUD VENCIDA"        
    ];
}
