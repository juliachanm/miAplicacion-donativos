# =============================
# Dockerfile para Railway - PHP + Apache
# =============================

# Imagen base PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias de PHP para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar todo el código de tu proyecto al contenedor
COPY . /var/www/html/

# Dar permisos correctos al directorio del proyecto
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configurar Apache para usar el puerto asignado por Railway
# Railway define la variable $PORT automáticamente
ENV APACHE_RUN_PORT=$PORT
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Habilitar mod_rewrite (si en algún momento necesitas URLs amigables)
RUN a2enmod rewrite

# Exponer el puerto del contenedor
EXPOSE $PORT

# Iniciar Apache en primer plano
CMD ["apache2-foreground"]
