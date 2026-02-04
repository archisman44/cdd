FROM php:8.2-apache

# Disable all MPMs first (THIS IS THE KEY)
RUN a2dismod mpm_event mpm_worker || true

# Enable prefork MPM (required for PHP)
RUN a2enmod mpm_prefork

# Enable rewrite (optional but common)
RUN a2enmod rewrite

# Install PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copy app files
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
