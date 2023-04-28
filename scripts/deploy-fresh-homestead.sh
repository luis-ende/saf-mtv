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
npm run build
# php artisan config:clear
vagrant exit
