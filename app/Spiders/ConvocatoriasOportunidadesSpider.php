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
    private const FIELD_MAPPINGS = [
        'Fecha de publicación' => 'fecha_publicacion',
        'Tipo de contratación' => 'tipo_contratacion',
        'Carácter' => 'caracter',
        'Método de contratación' => 'metodo_contratacion',
        'Entidad convocante' => 'entidad_convocante',
        'Presentación de propuestas' => 'fecha_presentacion_propuestas',
    ];

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
        $concursos = $this->extraerConcursos($response);
        yield $this->item($concursos);        
    }

    /**
     * Obtiene datos de concursos vigentes
     */
    private function extraerConcursos(Response $response): array
    {
        $cards = $response->filter('div.card');

        $items = [];
        $cards->each(function($item) use(&$items) {
            $cardInfo = [
                'nombre_procedimiento' => $item->children()->filter('h5.card-header')->text(),
            ];

            $formFields = $item->children()->filter('div.card-body')->children()->filter('div.form-row');

            $formFields->each(function($f) use(&$cardInfo) {
                $fieldLabel = $f->first()->children()->first()->children()->eq(0)->text();
                $field = self::FIELD_MAPPINGS[$fieldLabel] ?? $fieldLabel;
                $fieldValue = $f->first()->children()->first()->children()->eq(1)->text();
                $cardInfo[$field] = $fieldValue;

                if ($field === 'fecha_publicacion') {
                    $fieldLabel = $f->first()->children()->eq(1)->children()->eq(0)->text();
                    $field = self::FIELD_MAPPINGS[$fieldLabel] ?? $fieldLabel;
                    $fieldValue = $f->first()->children()->eq(1)->children()->eq(1)->text();
                    $cardInfo[$field] = $fieldValue;
                }                
            });

            // Extraer enlace a página de detalle de información del concurso.
            $boton = $item->children()->filter('div.card-body')->children()->filter('div.mt-auto');
            $link = $boton->first()->filter('a')->link()->getUri();
            $cardInfo['fuente_url'] = $link;

            $items[] = $cardInfo;
        });

        return $items;
    }    
}
