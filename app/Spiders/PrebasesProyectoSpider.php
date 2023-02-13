<?php

namespace App\Spiders;

use Generator;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;

class PrebasesProyectoSpider extends BasicSpider
{
    // Se llena dinámicamente con URLs de proyectos prebases a procesar
    public array $startUrls = [     
        // 'https://prebasestianguisdigital.cdmx.gob.mx/preview/contrato-abierto-para-la-instalacion-reparacion-y-mantenimiento-de-equipos-electricos-hidraulicos-e-hidroneumaticos-en-inmuebles-del-iems',   
        // 'https://prebasestianguisdigital.cdmx.gob.mx/details/prebases-para-la-prestacion-de-servicios-de-peaje-y-control-de-acceso-en-la-linea-6-y-7-del-metrobus-de-la-cdmx',
        // 'https://prebasestianguisdigital.cdmx.gob.mx/details/adquisicion-de-autobus-sencillo-para-prestar-el-servicio-publico-de-transporte-de-pasajeros-en-alta-montana',
    ];

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
    ];

    public array $spiderMiddleware = [
        //
    ];

    public array $itemProcessors = [
        //
    ];

    public array $extensions = [
        LoggerExtension::class,
        StatsCollectorExtension::class,
    ];

    public int $concurrency = 2;

    public int $requestDelay = 1;

    /**
     * @return Generator<ParseResult>
     */
    public function parse(Response $response): Generator
    {
        $proyecto = $this->extraeProyecto($response);
        
        yield $this->item($proyecto);
    }

    private function extraeProyecto(Response $response): array
    {
        $proyecto = [];
        $proyectoCard = $response->filter('#project-general-small');
        $proyecto['unidad_responsable'] = $proyectoCard->children()->eq(0)->children()->eq(1)->children()->eq(0)->children()->eq(2)->children()->eq(1)->text();
        $proyecto['tipo_contratacion'] = $proyectoCard->children()->eq(0)->children()->eq(1)->children()->eq(1)->children()->eq(0)->children()->eq(1)->text();
        $proyecto['metodo_contratacion'] = $proyectoCard->children()->eq(0)->children()->eq(1)->children()->eq(1)->children()->eq(1)->children()->eq(1)->text();
        $proyecto['partidas'] = $proyectoCard->children()->eq(0)->children()->eq(1)->children()->eq(3)->children()->eq(1)->text();

        return $proyecto;
    }
}