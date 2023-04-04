<?php

namespace App\Filament\Resources\ObjetivoTareaResource\Pages;

use App\Filament\Resources\ObjetivoTareaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Cache;

class CreateObjetivoTarea extends CreateRecord
{
    protected static string $resource = ObjetivoTareaResource::class;

    protected function afterCreate()
    {
        Cache::forget('objetivos_tareas');
    }
}
