FROM php:8.2-apache

# Enable Apache mod_rewrite (important for PHP apps)
RUN a2enmod rewrite

# Copy app files
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Railway expects a running foreground process
EXPOSE 80

CMD ["apache2-foreground"]
