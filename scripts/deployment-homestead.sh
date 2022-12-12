#!/bin/bash

echo ""
echo "###############################################"
echo "## Actualizando servidor local Homestead...  ##"
echo "###############################################"
echo ""

cd ..
git pull origin main
cd Homestead
vagrant ssh
cd /var/www/saf-mtv
composer install
php artisan migrate
npm run build
vagrant exit