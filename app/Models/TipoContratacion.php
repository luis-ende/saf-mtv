<?php

namespace App\Models;

enum TipoContratacion: string
{
    case AdquisicionBienes = 'Adquisición de Bienes';
    case PrestacionServicios = 'Prestación de Servicios';
}
