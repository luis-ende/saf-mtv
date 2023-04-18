<?php

namespace App\Filament\Resources\UsuarioURGResource\Pages;

use App\Filament\Resources\UsuarioURGResource;
use App\Mail\NotificacionUsuarioUrgActivado;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditUsuarioURG extends EditRecord
{
    protected static string $resource = UsuarioURGResource::class;
    protected bool $enviarNotificacion = false;

    protected function getActions(): array
    {
        return [
            //Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave()
    {
        $estadoAnterior = User::where('id', $this->data['id'])->value('activo');
        $this->enviarNotificacion = ($estadoAnterior === false) &&
                                    ($this->form->getState()['activo'] === true);
    }

    protected function afterSave()
    {
        if ($this->enviarNotificacion) {
            Mail::to($this->data['urg']['email'])
                ->send(new NotificacionUsuarioUrgActivado());
        }
    }
}
