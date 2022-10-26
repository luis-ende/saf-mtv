<?php

namespace App\Wizards\Registro;

use Arcanist\Action\WizardAction;
use Arcanist\Action\ActionResult;

class RegistroAction extends WizardAction
{
    public function execute($payload): ActionResult
    {


        return $this->success();
    }
}
