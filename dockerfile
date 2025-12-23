FROM php:8.2-apache

# Copier le contenu de src dans /var/www/html
COPY src/ /var/www/html/

# Activer rewrite si besoin
RUN a2enmod rewrite

# Définir le dossier de travail sur public
WORKDIR /var/www/html/public

# Mettre public comme racine web Apache
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
