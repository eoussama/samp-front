# Getting a base images
FROM php:7-apache

# Apache setup
ENV APACHE_DOCUMENT_ROOT /var/www/

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN docker-php-ext-install pdo pdo_mysql

# Copy source code
COPY ./ ./../
RUN chown -R www-data:www-data /var/www/

# Exposing ports
EXPOSE 80

# Defining the initial command
CMD ["apache2-foreground"]
