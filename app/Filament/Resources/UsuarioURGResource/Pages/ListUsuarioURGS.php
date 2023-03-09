<?php

namespace App\Filament\Resources\UsuarioURGResource\Pages;

use App\Filament\Resources\UsuarioURGResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsuarioURGS extends ListRecords
{
    protected static string $resource = UsuarioURGResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
