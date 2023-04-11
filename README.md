# Proyecto Mi Tiendita Virtual

## Requerimientos

- PHP 8.1+
- Laravel 9 (Vite) / Blade Components
- PostgreSQL 13
- [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
- [Tailwind 3](https://tailwindcss.com/docs/installation)
- [Alpine.js](https://alpinejs.dev/)
- Composer 2
- Node.js 16+ (compilación de assets)
- Nginx o Apache (servidor web para producción)

## Instalación del ambiente local de desarrollo

- VirtualBox 6.1
- Vagrant 2.3.1
- Laravel Homestead (ver servicios que se instalan por default en el ambiente de desarrollo en: https://laravel.com/docs/9.x/homestead#included-software)
 
- Para levantar el proyecto en modo local de desarrollo ir a la carpeta `Homestead` de la carpeta del repositorio MTV
- Copiar el archivo `Homestead.example.yaml` como `Homestead.yaml` y ajustar rutas de directorios locales (en Windows el formato de las rutas debe ajustarse, ver https://laravel.com/docs/9.x/homestead#configuring-shared-folders)
- Ejecutar `composer install` (es necesario tener instalados PHP y Composer en la máquina host)
- Es necesario agregar el DNS local (saf-mtv.test) al archivo `hosts` (Por ejemplo, agregar la línea: 192.168.56.56	saf-mtv.test)
- Ejecutar `vagrant up`
- El sitio local debe estar disponible al abrir la url `saf-mtv.test` en el navegador

- En modo de desarrollo ejecutar `npm run dev` para ver reflejados inmediatamente los cambios en archivos css y js (en la máquina host, no dentro de la máquina virtual)

- En Windows, crear symlink en `public` para la carpeta de imagenes de logotipos temporales, por ejemplo (en una ventana de comando): `mklink /D storage ..\..\storage`

- Desde la carpeta `Homestead` del proyecto
  - Para detener la máquina virtual: `vagrant halt`
  - Para eliminar la máquina virtual: `vagrant destroy`
  - Para loggearse via SSH a la máquina virtual: `vagrant ssh`

- La máquina virtual ejecuta un script bash (ver `Homestead/after.ssh`) después de arrancar para ejecutar algunos comandos adicionales para el sitio MTV.

**IMPORTANTE:** Se recomienda levantar el proyecto en el ambiente de desarrollo con Homestead, ya que la máquina virtual contiene todos los requerimientos necesarios que de otra manera sería necesario instalar en el host.

- Para realizar una actualización completa del ambiente de desarrollo ejecutar desde el directorio raíz del proyecto: `./scripts/deploy-fresh-homestead.sh` (la base de datos local será restaurada completamente, por lo que se recomienda hacer un backup si se quieren conservar datos de prueba generados)

- Generar respaldo de la base de datos en producción (u otro ambiente), ejemplo:
  - `pg_dump -U saf_mtv_dbuser -W -d saf_mtv > mtv_saf_db_20Feb2023.sql`

- Para restaurar un respaldo local en el servidor local de desarrollo (Homestead):
  - Entrar al servidor Homestead con `vagrant ssh`, después al servidor Postgresql con `psql -h homestead -U saf_mtv_dbuser -d saf_mtv`
  - Eliminar el esquema `public` de la base de datos `saf_mtv` y recrearla vacía:
    - `DROP SCHEMA public CASCADE` y `CREATE SCHEMA public` 
  - Importar el archivo de respaldo (cambiar ubicación del archivo de respaldo a utilizar):
    - `psql -v ON_ERROR_STOP=1 -h homestead -U saf_mtv_dbuser -W -d saf_mtv < database/backups/mtv_saf_db_20Feb2023.sql`

- No olvidar copiar la carpeta `storage`, en donde se guardan imágenes y documentos

**IMPORTANTE:** El archivo .env contiene las variables TEST_MODE, API_URL_BUSQUEDA_RFC_PADRON_PROVEEDORES, API_URL_BUSQUEDA_CURP, las cuales apuntan a endpoints de prueba. En modo producción TEST_MODE debe ser `false` y las URLs de las APIs deben apuntar a URLs en producción.

## Ambiente de desarrollo y pruebas en contenedores Docker

- Instrucciones para instalar Docker y Docker Compose en Linux: [https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository](https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository)
  - En Windows [https://docs.docker.com/desktop/install/windows-install/](https://docs.docker.com/desktop/install/windows-install/)
- Desde la carpeta raíz del proyecto, ir al subdirectorio `scripts` y ejecutar `sh docker-build.sh` para generar la imagen de Docker y levantar los contenedores del proyecto
  - En Windows: Abrir el archivo docker-build.sh y comentar o descomentar líneas según el sistema operativo (Windows/Linux). Ejecutar en una terminal (preferiblemente PowerShell) como Administrador
- Para acceder al contenedor de PostgreSQL y la base de datos de MTV con psql: `docker compose exec postgres psql -U saf_mtv_dbuser -W -d saf_mtv`
- Para correr un servidor de correo de desarrollo local para pruebas (Mailhog): `docker run --name safmtv-mailhog --network="saf-mtv_safmtv" -p 8025:8025 -p 1025:1025 -d mailhog/mailhog`
  - Usar el ID del contenedor como host en el archivo .env (`MAIL_HOST`)

### Compilación de assets

- Para generar los assets desde la carpeta raíz del proyecto ejecutar: `npm run build`
  - Eventualmente puede ser necesario ejecutar primero `npm install`
- `npm run dev` permite ver los cambios realizados en el código en el navegador sin tener que compilar los assets cada vez

### SVGs

- Los íconos utilizados en format SVG se encuentran en la carpeta `resources/svg` como archivos .svg y se utilizan en plantillas Blade con la directiva `@svg`, por ejemplo: `@svg('govicon-building')`. Ver más acerca sobre los íconos de [Blade UI Kit](https://blade-ui-kit.com/blade-icons).

### Paquetes de Laravel utilizados en el proyecto (`composer.json`)

- Íconos svg en templates Balde: Blade UI Kit - [https://github.com/blade-ui-kit/blade-icons](https://github.com/blade-ui-kit/blade-icons)
- Gestión de fuentes Google: Laravel Google Fonts - [https://github.com/spatie/laravel-google-fonts](https://github.com/spatie/laravel-google-fonts)
- Roles y permisos: Spatie Laravel Permission - [https://spatie.be/docs/laravel-permission/v5/introduction](https://spatie.be/docs/laravel-permission/v5/introduction)
- Imágenes y documentos adjuntos de productos y perfil de negocio: Spatie Media Library - [https://spatie.be/docs/laravel-medialibrary/v10/introduction](https://spatie.be/docs/laravel-medialibrary/v10/introduction)
- Importación y exportación de datos en formato Excel: Laravel Excel (by Spartner) - [https://laravel-excel.com/](https://laravel-excel.com/)
- Exportación de datos en formato Pdf: barryvdh/laravel-dompdf - [https://github.com/barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)
- Marca de favoritos de productos: [https://github.com/maize-tech/laravel-markable](https://github.com/maize-tech/laravel-markable)
  - Los favoritos de productos se encuentran en la tabla `markable_favorites`
  - Las alertas de oportunidades de negocio se encuentran en la tabla `markable_bookmarks`
- Mensajes simples entre usuarios mediante la plataforma: [https://github.com/cmgmyr/laravel-messenger](https://github.com/cmgmyr/laravel-messenger)
  - Ver ejemplos de uso en: [https://github.com/cmgmyr/laravel-messenger/blob/master/examples/MessagesController.php](https://github.com/cmgmyr/laravel-messenger/blob/master/examples/MessagesController.php)
- Enlaces de redes sociales (en este proyecto se usan solamente las funciones para generar los enlaces, no los botones en el front-end): https://github.com/jorenvh/laravel-share
- Para la extracción de datos vía [web scrapping](https://es.wikipedia.org/wiki/Web_scraping) de los sitios de Concurso Digital y Prebases se utiliza el paquete: Laravel Roach PHP - [https://roach-php.dev/docs/laravel/](https://roach-php.dev/docs/laravel/). Para abrir una línea de comando interactiva usar: `php artisan roach:shell https://roach-php.dev/docs/introduction` O para ejecutar un spider específico (desde el directorio raíz del proyecto), por ejemplo: `vendor/bin/roach roach:run App\\Spiders\\PrebasesOportunidadesSpider`
- Panel de administración de Mi Tiendita Virtual (para catálogos y configuración de la plataforma): Filament - [https://filamentphp.com](https://filamentphp.com)
- Tokens para APIs: Laravel Sanctum - [https://laravel.com/docs/9.x/sanctum#issuing-api-tokens](https://laravel.com/docs/9.x/sanctum#issuing-api-tokens)

## Producción y carga de catálogos y datos predefenidos:

- Consideraciones para el despliegue en ambiente de producción (primera instalación):
  - Generar llave de aplicación, ejecutar: `php artisan key:generate` 
  - Ajustes al archivo .env en producción:
    - APP_URL debe apuntar al dominio correcto
    - APP_DEBUG=false
    - TEST_MODE=false
    - DB_DATABASE, DB_USERNAME, DB_PASSWORD deben apuntar a valores de producción (no los defaults de desarrollo)
  - Precargado de fuentes, ejecutar: `php artisan google-fonts:fetch`
  - `database/seeders/DatabaseSeeder.php` (ejecutar `php artisan db:seed`) carga catálogos de MTV
  - `database/seeders/CatCiudadanoCABMSSeeder.php` (ejecutar `php artisan db:seed --class=CatCiudadanoCABMSSeeder`) carga los catálogos relacionados con el catálogo CABMS (importados previamente de un archivo Excel a CSV y luego a SQL)
  - **Para las búsquedas por palabra clave basadas en "lógica difusa" es necesario activar la extensiión `pg_trgm` en PostgreSQL.** 
    - En línea de comando con psql, revisar si la extensión ya se encuentra activada usar: `\dx`
    - Para activar la extensión: `CREATE EXTENSION pg_trgm;`
    - Más información sobre la extensión y su uso: https://www.postgresql.org/docs/current/pgtrgm.html
  - Algunos catálogos se guardan en cache (por ejemplo, ver clase `OportunidadNegocioRepository`), se puede usar `Cache::flush()` para eliminar todos los caches, o uno específico con `Cache::forget('key')` según sea el caso
  - La tabla `cat_ciudadano_cabms` se carga solamente para crear y llenar las tablas `cat_sectores`, `cat_categorias_scian` y `cat_cabms`, pero puede ser eliminada después para ahorrar espacio
  - La carga predeterminada de datos del Calendario de compras desde un archivo Excel se ejecuta mediante un seeder: `php artisan db:seed --class=ComprasProcedimientosSeeder`
  - La carga predeterminada de datos de preguntas frecuentes desde un archivo Excel se ejecuta mediante un seeder: `php artisan db:seed --class=PreguntasFrecuentesSeeder`
  - Para generar token de autenticación para el usuario super administrador (mtvadmin) se puede usar el comando `php artisan mtv:gen-token {user_id}`
  - Ver más información acerca de los seeders en la documentación del proyecto en la carpeta **[docs](docs/funcionalidad/README.md)**

### Integraciones de MTV con otros sistemas:

- [OK] Consulta de estatus de RFC en **Padrón de Proveedores**. Utilizado desde MTV para verificar si un RFC a utilizar ya existe en Padrón de Proveedores

- [OK] Consulta de datos del CURP desde el endpoint interno de datos de RENAPO. Esta consulta es necesaria para completar los datos completos (nombre completo, fecha de nacimiento, etc.) del proveedor (persona física), una vez que ha proporcionado su CURP.

- [Pendiente] Consulta de datos de Perfil de Negocio y Contacto de un proveedor en **Padrón de Proveedores**. Consulta de datos de proveedor registrado en Padrón de Proveedores para crear y sincronizar la cuenta del proveedor durante el login en MTV

- [Pendiente] Consulta de estatus de contratación de un grupo de RFCs en **Padrón de Proveedores**. Consulta mediante API que recibe varios RFC de proveedores y devuelve los estatus de contratación de cada uno (ya sea que existan o no)

- [Pendiente] API Endpoint en MTV para crear y actualizar cuentas de URGs mediante información del portal de **Acceso Único**. De tal manera que los usuarios de URGs autorizados puedan tener acceso a MTV

- Integraciones para el Buscador de Oportunidades de Negocio: 
  - [Pendiente] Consulta de convocatorias abiertas desde el portal de **Concurso Digital** [https://panel.concursodigital.cdmx.gob.mx/convocatorias_publicas](https://panel.concursodigital.cdmx.gob.mx/convocatorias_publicas) y [https://brandmestudio-test.com/contrataciones-abiertas](https://brandmestudio-test.com/contrataciones-abiertas)
  - [Pendiente] Consulta de datos de compras programadas desde el portal de **Requisiciones** [https://dev.finanzas.cdmx.gob.mx/requisiciones/public/login](https://dev.finanzas.cdmx.gob.mx/requisiciones/public/login)
  - [Pendiente] Consulta de datos de convocatorias desde el portal de **Prebases** [https://prebasestianguisdigital.cdmx.gob.mx/](https://prebasestianguisdigital.cdmx.gob.mx/)
  - [Pendiente] Consulta de datos de precotizaciones desde el portal de **Precotizaciones** [https://dev.finanzas.cdmx.gob.mx/requisiciones/public/login](https://dev.finanzas.cdmx.gob.mx/requisiciones/public/login) y PAAAPS (Programa Anual de Adquisiciones, Arrendamientos y Prestación de Servicios)

  - En MTV la tabla `oportunidades_negocio` concentra todos los registro provenientes de las diferentes plataformas. Para la extracción de información se utilizan las clases/servicio ubicadas en `app/Services/OportunidadesNegocio`, las cuales transforman los registros de la fuente a oportunidad de negocio. Para extraer la información se utilizan seeders. Por ejemplo, el seeder `database/seeders/OportunidadNegocioSeeder.php` hace uso del servicio para importar convocatorias públicas del sitio de Concurso digital. Estos seeder pueden ser ejecutados con la misma regularidad (por ejemplo, una vez al día) o en diferentes tiempos según la frecuencia con que cambien los datos en la fuente.

### Documentación e información relacionada con el repositorio del proyecto

- Para consultar la lista de tareas abiertas y pendientes, ver: https://gitlab.com/saf-mtv/saf-mtv/-/issues
- ***Consultar documentación adicional sobre el proyecto en la carpeta `docs` de este repositorio***
  