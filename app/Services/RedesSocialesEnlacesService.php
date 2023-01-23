<?php declare(strict_types = 1);

namespace App\Services;

class RedesSocialesEnlacesService
{
    public static function generaEnlaces(string $url, string $titulo): array 
    {
        // Paquete usado para generar enlaces: https://github.com/jorenvh/laravel-share

        $socialShareLinks = \Share::page($url, $titulo)
                                    ->facebook()
                                    ->twitter()
                                    ->getRawLinks();        

        return $socialShareLinks;
    }
}