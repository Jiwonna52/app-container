# Use the official PHP 7.4 image with Apache
FROM php:7.4-apache

# Install necessary extensions and tools
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli

# Install Redis PHP extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html/

# Copy the rest of the application code
COPY src/ /var/www/html/

# Install PHP dependencies using Composer
RUN composer install

# Expose port 80 to access the server
EXPOSE 80

# When the container starts, Apache will be running
CMD ["apache2-foreground"]

