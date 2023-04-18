# Estructura del proyecto MTV

## Directorios en `app`

- La estructura de código del proyecto MTV se apega a la estructura estándar de un proyecto Laravel v. 9
- Para organizar mejor el código los controladores llaman a instancias de clases llamadas `Repositories` en donde se ha implementado la mayor parte de la funcionalidad que hace consultas y operaciones sobre la base de datos. Todos los `Repositories` utilizados por los contradores están ubicados dentro de la carpeta `app/Repositories`
- Para realizar algunas operaciones los controladores también llaman a instancias de clases de servicio, ubicadas en la carpeta `app/Services` 
- Para la importación y exportación de datos en formato Excel/CSV se usan clases ubicadas en las carpetas `app/Imports` y `app/Exports` (estándar del paquete https://laravel-excel.com/](https://laravel-excel.com)

## Plantillas Blade y componentes Front-end

- Las plantillas Blade utilizan [componentes](https://laravel.com/docs/9.x/blade#components) como se explica en la documentación oficial. Todos los componentes del proyecto están ubicados en la carpeta `resources/views/components`, algunos componentes tienen una clase asociada, dichas clases se encuentran en `app/View/Components`  
- Bootstrap (framework CSS) está incluído en el proyecto pero se usan únicamente algunos estilos y los componentes de acordeón colapsable en la página de Perfil de Negocio de proveedor y carrusel en la página principal
- **Importante:** JQuery no está cargado en el proyecto ya que se utilizan Alpine.js y vanilla JavaScript
- Para los estilos de páginas y componentes del front-end se utilizan sobre todo estilos de Tailwind CSS y JavaScript con la librería [Alpine.js](https://alpinejs.dev/), salvo algunas páginas (por ejemplo, la página principal) en donde se usan estilos CSS directos y vanilla JavaScript
- En lugar de clases para todos los elementos de la aplicación se ha optado por usar componentes Blade que encapsulan estilos (CSS) y funcionalidad (JavaScript)
- Los parámetros personalizados de Tailwind CSS se pueden encontrar en los archivos `tailwind.config.js`, `resources/css/app.css`
- Los estilos CSS adicionales de algunas páginas se encuentran en la carpeta `resources/sass`, la cual contiene el archivo `app.scss` con estilos de varios componentes (por ejemplo, SweetAlert o Choices.js) 
- Las librerías JavaScript importadas para el proyecto se pueden ver en el archivo `resources/js/app.js`, también en este archivo se encuentran las funciones globales usadas en bloques de Alpine.js
- Todos los íconos SVG utilizados en el proyecto se encuentran en la carpeta `resources/svg` y son usados en las plantillas Blade con la directiva `@svg` (Ver más en la documentación de [https://github.com/blade-ui-kit/blade-icons](https://github.com/blade-ui-kit/blade-icons))