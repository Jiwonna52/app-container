# Use the official PHP 7.4 image with Apache
FROM php:7.4-apache

# Install necessary extensions and tools
RUN docker-php-ext-install mysqli

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html/

# Copy your PHP scripts into the container
COPY src/ /var/www/html/

# Install PHP dependencies using Composer
RUN composer install

# Expose port 80 to access the server
EXPOSE 80

# When the container starts, Apache will be running
CMD ["apache2-foreground"]
