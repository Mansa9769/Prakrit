FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy your PHP code into the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Set proper permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Expose Apache port
EXPOSE 80
