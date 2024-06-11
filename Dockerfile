# Use the official PHP 7.4 image with Apache
FROM php:7.4-apache

# Install necessary extensions and tools
RUN docker-php-ext-install mysqli

# Install Redis extension using pecl
RUN pecl install redis && docker-php-ext-enable redis

# Set the working directory
WORKDIR /var/www/html/

# Copy composer.json and composer.lock if exists
COPY src/composer.json src/composer.lock ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies using Composer
RUN composer install

# Copy the rest of the application code
COPY src/ /var/www/html/

# Expose port 80 to access the server
EXPOSE 80

# When the container starts, Apache will be running
CMD ["apache2-foreground"]
