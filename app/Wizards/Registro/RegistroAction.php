<?php

namespace App\Wizards\Registro;

use Arcanist\Action\WizardAction;
use Arcanist\Action\ActionResult;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Services\RegistroPersonaService;
use App\Models\User;
use App\Models\Persona;
use App\Models\PersonaFisica;
use App\Models\PersonaMoral;
use App\Models\PerfilNegocio;
use App\Models\CatalogoProductos;
use App\Models\Producto;

class RegistroAction extends WizardAction
{
    public function execute($payload): ActionResult
    {
        return $this->ejecutaRegistro($payload, new RegistroPersonaService());
    }

    public function ejecutaRegistro($payload, RegistroPersonaService $registroService): ActionResult
    {
        // TODO: Validaciones pendientes:
        // - Validar que el RFC no exista ya en padrón de proveedores
        // - Validar que el RFC sea de la longitud y formato correctos

        try {
            $registroService->registraPersonaMTV($payload);
        } catch (Exception $e) {
            return $this->failure(
                'El proceso de registro no pudo ser completado debido a un error interno.'
            );
        }


        return $this->success();
    }
}
