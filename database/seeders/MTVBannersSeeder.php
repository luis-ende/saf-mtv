<?php

namespace Database\Seeders;

use App\Models\Banners\MTVBanner;
use App\Models\Banners\MTVBannerTipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MTVBannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MTVBanner::create([
            'tipo' => MTVBannerTipo::EscritorioProveedor->value,
            'ruta_imagen' => '/images/banners/banner_01.png',
            'enlace' => 'https://dev.finanzas.cdmx.gob.mx/requisiciones/public/login',
        ]);
        MTVBanner::create([
            'tipo' => MTVBannerTipo::EscritorioProveedor->value,
            'ruta_imagen' => '/images/banners/banner_02.png',
            'enlace' => 'https://prebasestianguisdigital.cdmx.gob.mx/',
        ]);
        MTVBanner::create([
            'tipo' => MTVBannerTipo::EscritorioProveedor->value,
            'ruta_imagen' => '/images/banners/banner_03.png',
            'enlace' => 'https://panel.concursodigital.cdmx.gob.mx/convocatorias_publicas',
        ]);
        MTVBanner::create([
            'tipo' => MTVBannerTipo::EscritorioProveedor->value,
            'ruta_imagen' => '/images/banners/banner_04.png',
            // Enlace no proporcionado
//            'enlace' => '',
        ]);
    }
}
