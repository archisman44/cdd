FROM php:8.2-apache

# Disable all MPMs, then enable prefork ONLY
RUN a2dismod mpm_event mpm_worker || true \
 && a2enmod mpm_prefork rewrite

# Set Apache document root
WORKDIR /var/www/html

# Copy app files
COPY . .

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
