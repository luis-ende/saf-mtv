# SAF - MTV

## Requerimientos

- Laravel 9
- PostgreSQL 13

## Dependencias:

- Consulta de RFC en Padrón de Proveedores mediante API 
- Consulta de CURP mediante API

## Ambiente local de desarrollo

- VirtualBox 6.1
- Vagrant 2.3.1
- Laravel Homestead (ver servicios que se instalan por default en el ambiente de desarrollo en: https://laravel.com/docs/9.x/homestead#included-software)
 
- Para levantar el proyecto en modo local ir a la carpeta `Homestead`
- Copiar el archivo `Homestead.example.yaml` como `Homestead.yaml` y ajustar rutas de directorios locales (en Windows el formato de las rutas debe ajustarse, ver https://laravel.com/docs/9.x/homestead#configuring-shared-folders)
- Es necesario agregar el DNS local (saf-mtv.test) `hosts` (Agregar línea 192.168.56.56	saf-mtv.test)
- Ejecutar `vagrant up`
- El sitio local debe estar disponible en el url `saf-mtv.test`

- En modo de desarrollo ejecutar `npm run dev` para ver reflejados inmediatamente los cambios en archivos css y js

- En Windows, crear symlink en `public` para la carpeta de imagenes de logotipos temporales, por ejemplo (en una ventana de comando): `mklink /D storage ..\..\storage`

## MTV en Docker

- Instrucciones para instalar Docker y Docker Compose en Linux: [https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository](https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository)
  - En Windows [https://docs.docker.com/desktop/install/windows-install/](https://docs.docker.com/desktop/install/windows-install/)
- Desde la carpeta raíz del proyecto, rr al subdirectorio `scripts` y ejecutar `docker-build.sh` para generar la imagen de Docker y levantar los contenedores del proyecto
