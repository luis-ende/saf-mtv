<?php

namespace App\Filament\Resources\PreguntaFrecuenteResource\Pages;

use App\Filament\Resources\PreguntaFrecuenteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPreguntaFrecuentes extends ListRecords
{
    protected static string $resource = PreguntaFrecuenteResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
