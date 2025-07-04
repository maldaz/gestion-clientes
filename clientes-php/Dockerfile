FROM php:8.2-apache

# Extensiones necesarias para SQL Server
RUN apt-get update && apt-get install -y \
    libxml2-dev unixodbc-dev gnupg2 curl unzip \
    && pecl install sqlsrv pdo_sqlsrv \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv

# Configuración básica
COPY . /var/www/html/
WORKDIR /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

EXPOSE 80
