# Imagen de PHP con Apache
FROM php:8.2-apache

# Extensión MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar el código al servidor Apache
COPY . /var/www/html/

# Dar permisos necesarios
RUN chown -R www-data:www-data /var/www/html
