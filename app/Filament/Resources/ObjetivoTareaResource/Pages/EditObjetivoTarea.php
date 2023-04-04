<?php

namespace App\Filament\Resources\ObjetivoTareaResource\Pages;

use App\Filament\Resources\ObjetivoTareaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

class EditObjetivoTarea extends EditRecord
{
    protected static string $resource = ObjetivoTareaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave()
    {
        Cache::forget('objetivos_tareas');
    }

    protected function afterDelete()
    {
        Cache::forget('objetivos_tareas');
    }
}
