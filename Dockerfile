FROM php:7.4-fpm-alpine

ARG user  # Username for the application user
ARG uid  # User ID for the application user

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Get latest Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN alias composer='php /usr/bin/composer'

# Set working directory
WORKDIR /var/www

COPY . /var/www
COPY php.ini /usr/local/etc/php/php.ini

RUN composer install

# Set ownership of application files (optional, adjust based on your needs)
RUN chown -R www-data:www-data /var/www/vendor

# Expose web server port (optional, adjust based on your setup)
EXPOSE 9000

# Use the existing www-data user (adjust if needed)
USER www-data

# Run the application using artisan serve
CMD php artisan serve --host=0.0.0.0
