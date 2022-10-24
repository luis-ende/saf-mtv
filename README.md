# SAF - MTV

## Requerimientos

- VirtualBox 6.1
- Vagrant 2.3.1

## Ambiente local de desarrollo
 
- Para levantar el proyecto en modo local ir a la carpeta `Homestead`
- Ejecutar dentro de la carpeta `composer install`
- Copiar el archivo `Homestead.example.yaml` como `Homestead.yaml` y ajustar rutas de directorios locales
- Ejecutar `vagrant up`
- Es necesario agregar el DNS local (saf-mtv.text) `hosts` (Agregar línea 192.168.56.56	saf-mtv.test)
