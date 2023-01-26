#!/bin/bash

echo ""
echo "###############################################"
echo "## Restaurando db local Homestead      ...   ##"
echo "###############################################"
echo ""

php artisan migrate:fresh
php artisan db:seed
