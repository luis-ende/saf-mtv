<?php

namespace App\Repositories;

use App\Models\Banners\MTVBanner;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class MTVBannersRepository
{
    public function obtieneBanners(int $tipo): Collection
    {
        $banners = Cache::rememberForever('mtv_banners', function() {
            return MTVBanner::all();
        });

        return $banners->where('tipo', $tipo);
    }
}