FROM php:8.2-apache

# Extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Arreglar ports.conf y asegurarlo correctamente
RUN echo "Listen 80" > /etc/apache2/ports.conf

# Asegurar que también está en sites-enabled
RUN sed -i 's/Listen .*/Listen 80/' /etc/apache2/ports.conf

# Copiar la aplicación
COPY . /var/www/html/

# Permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
