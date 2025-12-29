FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libonig-dev \
    libzip-dev \
    unzip \
 && docker-php-ext-install pdo_mysql mysqli

RUN a2enmod rewrite

COPY src/ /var/www/html/

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html/public
EXPOSE 80
