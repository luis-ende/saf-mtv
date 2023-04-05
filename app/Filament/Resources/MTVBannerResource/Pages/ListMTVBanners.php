<?php

namespace App\Filament\Resources\MTVBannerResource\Pages;

use App\Filament\Resources\MTVBannerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMTVBanners extends ListRecords
{
    protected static string $resource = MTVBannerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
