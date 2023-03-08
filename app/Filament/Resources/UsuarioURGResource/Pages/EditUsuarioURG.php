<?php

namespace App\Filament\Resources\UsuarioURGResource\Pages;

use App\Filament\Resources\UsuarioURGResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsuarioURG extends EditRecord
{
    protected static string $resource = UsuarioURGResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
