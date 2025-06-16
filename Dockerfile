FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git zip unzip curl libpq-dev libonig-dev libzip-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip

RUN a2enmod rewrite
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html
WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN composer install --no-dev --optimize-autoloader

COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf
