FROM php:8.2-apache

# 🔥 FORCE REMOVE all MPM configs
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load \
    && rm -f /etc/apache2/mods-enabled/mpm_*.conf

# ✅ Enable ONLY prefork MPM
RUN a2enmod mpm_prefork

# Enable rewrite
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy app
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
