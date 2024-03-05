# Usa la imagen oficial de PHP 8 como base
FROM php:8-apache

# Instala las extensiones y herramientas necesarias
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        unzip \
        git \
    && docker-php-ext-install pdo_mysql zip

# Habilita el módulo de Apache mod_rewrite
RUN a2enmod rewrite

# Configura el servidor Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de tu aplicación al contenedor
COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala las dependencias de Composer
# RUN composer install

# Asigna permisos adecuados
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto 80 para acceder a la aplicación web
EXPOSE 80

# Comando para iniciar Apache y mantener el contenedor en ejecución
CMD ["apache2-foreground"]
