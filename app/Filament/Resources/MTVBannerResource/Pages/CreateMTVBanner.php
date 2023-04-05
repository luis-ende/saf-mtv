<?php

namespace App\Filament\Resources\MTVBannerResource\Pages;

use App\Filament\Resources\MTVBannerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Cache;

class CreateMTVBanner extends CreateRecord
{
    protected static string $resource = MTVBannerResource::class;

    protected function afterCreate()
    {
        Cache::forget('mtv_banners');
    }
}
