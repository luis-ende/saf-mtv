<?php

namespace App\Spiders;

use Generator;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;

class PrebasesOportunidadesSpider extends BasicSpider
{
    public array $startUrls = [
        // Prebases abiertas
        'https://prebasestianguisdigital.cdmx.gob.mx/',
        // Prebases cerradas
        // 'https://prebasestianguisdigital.cdmx.gob.mx/?layout=grid&_token=IFmyUYPkc1VOgrlODODhKKbuD9E1SRvS31AFNQ1D&title=&entity=&status=C&sort=date_desc',
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
        $proyectos = $this->extraePrebases($response);
        
        yield $this->item($proyectos);
    }

    private function extraePrebases(Response $response): array
    {
        $grid = $response->filter('body > div > div > div > div.grid.grid-cols-1');
        $cards = $grid->children()->filter('div.border-2.border-gray-150');
        $proyectos = [];
        $cards->each(function($card) use(&$proyectos) {
            $cardInfo = [
                'nombre_proyecto' => $card->children()->eq(2)->text(),
                'estatus' => strtolower($card->children()->eq(1)->text()),
                'fecha_publicacion' => substr($card->children()->eq(3)->children()->eq(0)->children()->eq(1)->text(), 0, 10),
                'fecha_limite' => substr($card->children()->eq(3)->children()->eq(1)->children()->eq(1)->text(), 0, 10),
                'ente_publico' => $card->children()->eq(4)->children()->eq(0)->children()->eq(1)->text(),
                'fuente_url' => $card->children()->eq(5)->children()->filter('a')->link()->getUri(),
            ];  
            
            $proyectos[] = $cardInfo;
        });

        return $proyectos;
    }
}