# Use the official PHP 7.4 image with Apache
FROM php:7.4-apache

# Install mysqli for MariaDB/MySQL connections
#RUN docker-php-ext-install mysqli

# Install necessary extensions and tools
RUN apt-get update && \
    apt-get install -y libssl-dev && \
    docker-php-ext-install mysqli && \
    pecl install redis && \
    docker-php-ext-enable redis

# Copy your PHP scripts into the container
COPY src/ /var/www/html/

# Expose port 80 to access the server
EXPOSE 80

# When the container starts, Apache will be running
CMD ["apache2-foreground"]

