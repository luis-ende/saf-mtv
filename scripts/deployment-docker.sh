#!/bin/bash

echo ""
echo "###############################################"
echo "## Actualizando contenedor Docker       ...  ##"
echo "###############################################"
echo ""

cd ..
git pull origin main
docker compose exec app composer install
docker compose exec app npm run build
docker compose exec app php artisan migrate