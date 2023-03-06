<?php

namespace App\Filament\Resources\PreguntaFrecuenteResource\Pages;

use App\Filament\Resources\PreguntaFrecuenteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPreguntaFrecuente extends EditRecord
{
    protected static string $resource = PreguntaFrecuenteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
