<?php

namespace Database\Seeders;

use App\Models\ObjetivoTarea;
use App\Models\ObjetivoTareaCondicion;
use App\Models\ObjetivoTareaTipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObjetivosTareasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ObjetivoTarea::create([
            'objetivo' => 'Crear catálogo (Tiendita Virtual)',
            'sugerencia' => 'Conoce cómo crear Tu Tiendita Virtual',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoNoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Crear catálogo (Tiendita Virtual)',
            'sugerencia' => 'Vamos a crear Tu Tiendita Virtual',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoNoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/catalogo-registro-inicio',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Ampliar catálogo',
            'sugerencia' => 'Agrega otros productos',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoNoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/catalogo-registro-inicio',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Conocer MTV',
            'sugerencia' => 'Visita la sección Preguntas Frecuentes',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoNoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/preguntas-frecuentes',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Motivar a crear su catálogo',
            'sugerencia' => 'Conoce los catálogos de otros proveedores',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoNoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/buscador-mtv',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Guardar catálogo en PDF',
            'sugerencia' => 'Si tienes un catálogo en PDF, ¿Lo guardamos en tu perfil?',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoNoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/perfil-negocio',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Promover su catálogo',
            'sugerencia' => 'Vamos a compartir Tu Tiendita Virtual por Whatsapp',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoNoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/catalogo-productos',
        ]);

        ObjetivoTarea::create([
            'objetivo' => 'Buscar oportunidades de negocio',
            'sugerencia' => 'Busca nuevas oportunidades de negocio',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/oportunidades-de-negocio',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Buscar oportunidades de negocio',
            'sugerencia' => 'Conoce el catálogo de Bienes y Servicios',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => 'http://rmsg.df.gob.mx/rmsg/modulo/dai/cabms/',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Guardar oportunidades de tu interés',
            'sugerencia' => 'Revisa las oportunidades sugeridas',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/centro-notificaciones',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Guardar oportunidades de tu interés',
            'sugerencia' => 'Guardemos oportunidades de tu interés',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/oportunidades-de-negocio',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Conocer Mi Tiendita Virtual',
            'sugerencia' => 'Visita la sección "Preguntas frecuentes"',
            'objetivo_condicion' => ObjetivoTareaCondicion::CatalogoCreado->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/preguntas-frecuentes',
        ]);

        ObjetivoTarea::create([
            'objetivo' => 'Monitorear interacciones',
            'sugerencia' => 'Descubre quiénes siguen tus productos',
            'objetivo_condicion' => ObjetivoTareaCondicion::OportunidadesBuscadasGuardadas->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Generar leads',
            'sugerencia' => 'Contacta a quienes siguen tus productos',
            'objetivo_condicion' => ObjetivoTareaCondicion::OportunidadesBuscadasGuardadas->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/directorio',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Ampliar catálogo',
            'sugerencia' => 'Agrega otros productos',
            'objetivo_condicion' => ObjetivoTareaCondicion::OportunidadesBuscadasGuardadas->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/catalogo-registro-inicio',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Generar leads',
            'sugerencia' => 'Interactúa con las Instituciones compradoras',
            'objetivo_condicion' => ObjetivoTareaCondicion::OportunidadesBuscadasGuardadas->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Consideracion->value,
            'url_accion' => '/directorio',
        ]);

        ObjetivoTarea::create([
            'objetivo' => 'Conocer la programación anual',
            'sugerencia' => 'Descubre qué comprará la ciudad durante el año',
            'objetivo_condicion' => ObjetivoTareaCondicion::ObjetivosCumplidos->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Retencion->value,
            'url_accion' => '/calendario-compras',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Conocer otros catálogos',
            'sugerencia' => 'Vamos a conocer el catálogo de otros proveedores',
            'objetivo_condicion' => ObjetivoTareaCondicion::ObjetivosCumplidos->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Retencion->value,
            'url_accion' => '/buscador-mtv/productos',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Conocer proveedores',
            'sugerencia' => 'Conoce el perfil de otros proveedores',
            'objetivo_condicion' => ObjetivoTareaCondicion::ObjetivosCumplidos->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Retencion->value,
            'url_accion' => '/buscador-mtv/proveedores',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Actualizar perfil',
            'sugerencia' => 'Revisa tu Perfil de negocio y actualízalo',
            'objetivo_condicion' => ObjetivoTareaCondicion::ObjetivosCumplidos->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Retencion->value,
            'url_accion' => '/perfil-negocio',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Interactuar con MTV',
            'sugerencia' => 'Envíanos tus preguntas. Queremos escucharte',
            'objetivo_condicion' => ObjetivoTareaCondicion::ObjetivosCumplidos->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Retencion->value,
            // TODO Implementar ancla a formulario de contacto (#Contacto) en Página de preguntas frecuentes
            'url_accion' => '/preguntas-frecuentes#contacto',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Buscar oportunidades de negocio',
            'sugerencia' => 'Busca nuevas oportunidades de negocio',
            'objetivo_condicion' => ObjetivoTareaCondicion::ObjetivosCumplidos->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Retencion->value,
            'url_accion' => '/oportunidades-de-negocio',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Guardar oportunidades de tu interés',
            'sugerencia' => 'Guardemos oportunidades de tu interés',
            'objetivo_condicion' => ObjetivoTareaCondicion::ObjetivosCumplidos->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Retencion->value,
            'url_accion' => '/oportunidades-de-negocio',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Ampliar catálogo',
            'sugerencia' => 'Agrega otros productos',
            'objetivo_condicion' => ObjetivoTareaCondicion::ObjetivosCumplidos->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Retencion->value,
            'url_accion' => '/catalogo-registro-inicio',
        ]);
        ObjetivoTarea::create([
            'objetivo' => 'Generar leads',
            'sugerencia' => 'Interactúa con las Instituciones compradoras',
            'objetivo_condicion' => ObjetivoTareaCondicion::ObjetivosCumplidos->value,
            'tipo_objetivo' => ObjetivoTareaTipo::Retencion->value,
            'url_accion' => '/directorio',
        ]);
    }
}
