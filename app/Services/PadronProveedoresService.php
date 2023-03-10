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

    public const FILTRO_ESTATUS_PADRON_EN_REVISION = 1;
    public const FILTRO_ESTATUS_PADRON_CONSTANCIA_VIGENTE = 2;
    public const FILTRO_ESTATUS_PADRON_SIN_REGISTRO = 3;
    // Filtros usados para consultar estatus de proveedores desde MTV (Buscador de proveedores).
    public const FILTROS_ETAPAS_PADRON_PROVEEDORES_MTV = [
        self::FILTRO_ESTATUS_PADRON_EN_REVISION => 'En revisión', // Estatus en padrón: 2, 3, 4, 5
        self::FILTRO_ESTATUS_PADRON_CONSTANCIA_VIGENTE => 'Constancia vigente', // Estatus en padrón: 7
        self::FILTRO_ESTATUS_PADRON_SIN_REGISTRO => 'Sin registro' // Registro no existente en padrón
    ];
}
