# SAF - MTV

## Requerimientos

- VirtualBox 6.1
- Vagrant 2.3.1

## Ambiente local de desarrollo
 
- Para levantar el proyecto en modo local ir a la carpeta `Homestead`
- Copiar el archivo `Homestead.example.yaml` como `Homestead.yaml` y ajustar rutas de directorios locales (en Windows el formato de las rutas debe ajustarse, ver https://laravel.com/docs/9.x/homestead#configuring-shared-folders)
- Es necesario agregar el DNS local (saf-mtv.test) `hosts` (Agregar línea 192.168.56.56	saf-mtv.test)
- Ejecutar `vagrant up`
