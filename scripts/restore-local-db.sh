#!/bin/bash

echo ""
echo "###############################################"
echo "## Restaurando db local Homestead      ...   ##"
echo "###############################################"
echo ""

php artisan migrate:fresh
php artisan db:seed
export PGPASSWORD='secret'
psql -d saf_mtv -h homestead -U homestead -e -f /var/www/saf-mtv/Homestead/pgsql/cat_asentamientos.sql
