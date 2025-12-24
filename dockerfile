FROM php:8.2-apache

RUN apt-get update && apt-get install -y default-mysql-client libonig-dev libzip-dev

RUN docker-php-ext-install pdo pdo_mysql

COPY src/ /var/www/html/

RUN a2enmod rewrite

WORKDIR /var/www/html/public

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
