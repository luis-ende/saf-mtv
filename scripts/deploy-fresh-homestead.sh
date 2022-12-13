#!/bin/bash

echo ""
echo "###############################################"
echo "## Desplegando servidor local Homestead...   ##"
echo "###############################################"
echo ""

git pull origin main
cd Homestead
vagrant ssh
cd /var/www/saf-mtv
composer install
npm install
php artisan migrate:fresh
php artisan db:seed
psql -d saf_mtv -h homestead -U homestead -e -f /var/www/saf-mtv/Homestead/pgsql/cabms.sql
psql -d saf_mtv -h homestead -U homestead -e -f /var/www/saf-mtv/Homestead/pgsql/cat_asentamientos.sql
npm run build
vagrant exit