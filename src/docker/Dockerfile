# Getting a base images
FROM php:7-apache

# Copy source code
COPY ./ ./var/www/
RUN chown -R www-data:www-data /var/www

# Exposing ports
EXPOSE 80

# Defining the initial command
CMD ["apache2-foreground"]
