<?php

namespace App\Filament\Resources\ObjetivoTareaResource\Pages;

use App\Filament\Resources\ObjetivoTareaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjetivoTareas extends ListRecords
{
    protected static string $resource = ObjetivoTareaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
