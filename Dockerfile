# Imagen de PHP con Apache
FROM php:8.2-apache

# Extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Hacer que Apache escuche en el puerto $PORT de Railway (por defecto 8080)
ENV PORT=8080
RUN sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
RUN sed -i "s/:80/:${PORT}/" /etc/apache2/sites-available/000-default.conf

EXPOSE ${PORT}

# Copiar código
COPY . /var/www/html/

# Permisos
RUN chown -R www-data:www-data /var/www/html

CMD ["apache2-foreground"]
