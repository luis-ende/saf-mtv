<?php

namespace App\Filament\Resources\UnidadCompradoraResource\Pages;

use App\Filament\Resources\UnidadCompradoraResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnidadCompradoras extends ListRecords
{
    protected static string $resource = UnidadCompradoraResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
