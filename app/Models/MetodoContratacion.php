<?php

namespace App\Models;

enum MetodoContratacion: string
{
    case LicitacionPublica = 'Licitación pública';
    case InvitacionRestringida = 'Invitación restringida';
    case AdjudicacionDirecta = 'Adjudicación directa';
    case NoAplica = 'No aplica';
}
