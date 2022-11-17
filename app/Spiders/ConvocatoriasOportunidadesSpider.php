<?php

namespace App\Spiders;

use Generator;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use RoachPHP\Spider\ParseResult;

class ConvocatoriasOportunidadesSpider extends BasicSpider
{
    public array $startUrls = [
        'https://panel.concursodigital.cdmx.gob.mx/convocatorias_publicas'
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
        $cards = $response->filter('div.card');

        $items = [];
        $cards->each(function($item) use(&$items) {
            $cardInfo = [
                'nombre_procedimiento' => $item->children()->filter('h5.card-header')->text(),
            ];

            $formFields = $item->children()->filter('div.card-body')->children()->filter('div.form-row');

            $formFields->each(function($f) use(&$cardInfo) {
                $cardInfo[$f->first()->children()->first()->children()->eq(0)->text()] =
                        $f->first()->children()->first()->children()->eq(1)->text();
            });

            $items[] = $cardInfo;
        });

//        var_dump($items);

        yield $this->item(['convocatorias' => $items]);
    }
}
