<?php

namespace App\Filament\Resources\UnidadCompradoraResource\Pages;

use App\Filament\Resources\UnidadCompradoraResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

class EditUnidadCompradora extends EditRecord
{
    protected static string $resource = UnidadCompradoraResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->after(function () {
                    Cache::forget('cat_unidades_compradoras');
                }),
        ];
    }

    protected function afterSave()
    {
        Cache::forget('cat_unidades_compradoras');
    }
}
