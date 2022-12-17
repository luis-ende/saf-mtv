# SAF - MTV

## Requerimientos

- Laravel 9 (Vite) / Blade Components
- PostgreSQL 13
- Bootstrap 5 
- Tailwind 3
- Alpine.js

## Dependencias externas:

- Consulta de RFC en Padrón de Proveedores mediante API 
- Consulta de CURP mediante API

**IMPORTANTE:** El archivo .env contiene las variables TEST_MODE, API_URL_BUSQUEDA_RFC_PADRON_PROVEEDORES, API_URL_BUSQUEDA_CURP, las cuales apuntan a endpoints de prueba. En modo producción TEST_MODE debe ser `false` y las URLs de las APIs deben apuntar a direcciones en producción.

## Ambiente local de desarrollo

- VirtualBox 6.1
- Vagrant 2.3.1
- Laravel Homestead (ver servicios que se instalan por default en el ambiente de desarrollo en: https://laravel.com/docs/9.x/homestead#included-software)
 
- Para levantar el proyecto en modo local ir a la carpeta `Homestead` de la carpeta del repositorio MTV
- Copiar el archivo `Homestead.example.yaml` como `Homestead.yaml` y ajustar rutas de directorios locales (en Windows el formato de las rutas debe ajustarse, ver https://laravel.com/docs/9.x/homestead#configuring-shared-folders)
- Ejecutar `composer install` (es necesario tener instalados PHP y Composer en la máquina host)
- Es necesario agregar el DNS local (saf-mtv.test) `hosts` (Por ejemplo, agregar la línea: 192.168.56.56	saf-mtv.test)
- Ejecutar `vagrant up`
- El sitio local debe estar disponible al abrir la url `saf-mtv.test` en el navegador

- En modo de desarrollo ejecutar `npm run dev` para ver reflejados inmediatamente los cambios en archivos css y js

- En Windows, crear symlink en `public` para la carpeta de imagenes de logotipos temporales, por ejemplo (en una ventana de comando): `mklink /D storage ..\..\storage`

- Desde la carpeta `Homestead` del proyecto
  - Para detener la máquina virtual: `vagrant halt`
  - Para eliminar la máquina virtual: `vagrant destroy`
  - Para loggearse via SSH a la máquina virtual: `vagrant ssh`

- La máquina virtual ejecuta un script bash (ver `Homestead/after.ssh`) después de arrancar para ejecutar algunos comandos adicionales para el sitio MTV.

**IMPORTANTE:** Se recomienda levantar el proyecto en el ambiente de desarrollo con Homestead, ya que la máquina virtual contiene todos los requerimientos necesarios que de otra manera sería necesario instalar en el host.

Para realizar una actualización completa del ambiente de desarrollo ejecutar desde el directorio raíz del proyecto: `./scripts/deploy-fresh-homestead.sh` (la base de datos local será restaurada completamente, por lo que se recomienda hacer un backup si se quieren conservar datos de prueba generados)

### Compilación de assets

- Para generar los assets desde la carpeta raíz del proyecto ejecutar: `npm run build`
- `npm run dev` permite escuchar los cambios realizados en el código para refrescar el navegador sin tener que compilar los assets cada vez

### SVGs

- Los íconos utilizados en format SVG se encuentran en la carpeta `resources/svg` como archivos .svg y se utilizan en plantillas Blade con la directiva `@svg`, por ejemplo: `@svg('govicon-building')`. Ver más acerca sobre los íconos de [Blade UI Kit](https://blade-ui-kit.com/blade-icons).

## MTV en Docker

- Instrucciones para instalar Docker y Docker Compose en Linux: [https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository](https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository)
  - En Windows [https://docs.docker.com/desktop/install/windows-install/](https://docs.docker.com/desktop/install/windows-install/) 
- Desde la carpeta raíz del proyecto, ir al subdirectorio `scripts` y ejecutar `docker-build.sh` para generar la imagen de Docker y levantar los contenedores del proyecto
	- En Windows: Abrir el archivo docker-build.sh y comentar o descomentar líneas según el sistema operativo (Windows/Linux). Ejecutar en una terminal (preferiblemente PowerShell) como Administrador

## Producción:

- Consideraciones para el despliegue en ambiente de producción (primera instalación):
  - Generar llave de aplicación, ejecutar: `php artisan key:generate` 
  - Precargado de fuentes, ejecutar: `php artisan google-fonts:fetch`
  - `database/seeders/DatabaseSeeder.php` (ejecutar `php artisan db:seed`) carga catálogos de MTV
  - `database/seeders/CatCiudadanoCABMSSeeder.php` (ejecutar `php artisan db:seed --class=CatCiudadanoCABMSSeeder`) carga los catálogos relacionados con el catálogo CABMS (importados previamente de un archivo Excel a CSV y luego a SQL)
