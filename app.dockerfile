FROM php:8.1-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update \
    && apt-get install -y gnupg curl ca-certificates unzip lsb-release \
    && curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y \
        git \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libpq-dev \
        libzip-dev \
        nodejs \
        postgresql-client-13 \
    && npm install -g npm \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install PHP extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl zip bcmath gd intl exif

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN ln -s /var/www/storage/app/public /var/www/public/storage

# Set working directory
WORKDIR /var/www

USER $user
