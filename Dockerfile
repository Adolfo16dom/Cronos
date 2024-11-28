# Usa una imagen base de PHP con Apache
FROM php:8.1-apache

# Instala las extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli

# Copia tus archivos del proyecto a la carpeta raíz del servidor
COPY . /var/www/html/

# Da permisos adecuados a los archivos
RUN chown -R www-data:www-data /var/www/html
