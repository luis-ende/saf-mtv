#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.
#
# If you have user-specific configurations you would like
# to apply, you may also create user-customizations.sh,
# which will be run after this script.


# If you're not quite ready for the latest Node.js version,
# uncomment these lines to roll back to a previous version

# Remove current Node.js version:
#sudo apt-get -y purge nodejs
#sudo rm -rf /usr/lib/node_modules/npm/lib
#sudo rm -rf //etc/apt/sources.list.d/nodesource.list

# Install Node.js Version desired (i.e. v13)
# More info: https://github.com/nodesource/distributions/blob/master/README.md#debinstall
#curl -sL https://deb.nodesource.com/setup_13.x | sudo -E bash -
#sudo apt-get install -y nodejs

# Set to PHP 8 version used to develop this site
php81

sudo cp /var/www/saf-mtv/Homestead/nginx/saf-mtv.test /etc/nginx/sites-available/saf-mtv.test

# Create user for test database
sudo systemctl restart postgresql
export PGPASSWORD='secret'
psql -d saf_mtv -h homestead -U homestead -e -c "CREATE USER saf_mtv_dbuser WITH PASSWORD 'saf-mtv';"
psql -d saf_mtv -h homestead -U homestead -e -c "GRANT ALL PRIVILEGES ON DATABASE saf_mtv to saf_mtv_dbuser;"
# Cargar catálogo de asentamientos de prueba para modo desarrollo
psql -d saf_mtv -h homestead -U homestead -e -f /var/www/saf-mtv/Homestead/pgsql/cat_asentamientos.sql
# Cargar catálogo de claves cabms de prueba para modo desarrollo
psql -d saf_mtv -h homestead -U homestead -e -f /var/www/saf-mtv/Homestead/pgsql/cabms.sql

sudo service php8.1-fpm restart
sudo systemctl restart nginx

set -e

cd /var/www/saf-mtv
composer install
php artisan migrate

npm install && npm run build

# Crear link a carpeta de assets públicos
php artisan storage:link
