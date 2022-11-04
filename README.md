# SAF - MTV

## Requerimientos

- Laravel 9
- PostgreSQL 13

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