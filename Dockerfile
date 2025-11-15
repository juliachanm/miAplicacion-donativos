FROM php:8.2-apache

# Instalar extensiones MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar tu proyecto al servidor Apache
COPY . /var/www/html/

# Dar permisos
RUN chown -R www-data:www-data /var/www/html

# Apache SIEMPRE escucha en el puerto 80 dentro del contenedor
# Railway luego lo asigna al $PORT externamente
EXPOSE 80

CMD ["apache2-foreground"]
