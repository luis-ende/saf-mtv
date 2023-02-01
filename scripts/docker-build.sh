#!/bin/bash

echo ""
echo "###############################################"
echo "## Build and run project's Docker containers ##"
echo "###############################################"
echo ""

set -e # We want to fail at each command, to stop execution.

cd ..
cp -n .env.docker .env
#WINDOWS:
#docker compose build --build-arg user="saf-mtv" --build-arg uid="1001" app
#LINUX:
docker compose build --build-arg user="$(whoami)" --build-arg uid="$(id -u)" app
docker compose --env-file .env up -d
docker compose exec app rm -f /var/www/public/storage
docker compose exec app ln -s /var/www/storage/app/public /var/www/public/storage
docker compose exec app composer install
docker compose exec app npm install
docker compose exec app npm run build
docker compose exec app php artisan migrate
docker compose exec app php db:seed
