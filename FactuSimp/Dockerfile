# Install php 8
FROM php:8-apache

# Install php 8
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        unzip \
        git \
    && docker-php-ext-install pdo_mysql zip

# Enable the Apache mod_rewrite module
RUN a2enmod rewrite

# Configure the Apache server
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Work directory
WORKDIR /var/www/html

# Copy files
COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Expose port 80 to access the web application
EXPOSE 80

# start apache
CMD ["apache2-foreground"]
