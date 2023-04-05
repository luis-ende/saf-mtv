<?php

namespace App\Filament\Resources\MTVBannerResource\Pages;

use App\Filament\Resources\MTVBannerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

class EditMTVBanner extends EditRecord
{
    protected static string $resource = MTVBannerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()
                                    ->after(function () {
                                        Cache::forget('mtv_banners');
                                    }),
        ];
    }

    protected function afterSave()
    {
        Cache::forget('mtv_banners');
    }
}
