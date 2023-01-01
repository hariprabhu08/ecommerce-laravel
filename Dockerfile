FROM php:7.4-fpm-alpine

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Get latest Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN alias composer='php /usr/bin/composer'

# Set working directory
WORKDIR /var/www

COPY . /var/www

RUN composer install

COPY php.ini /usr/local/etc/php/php.ini

CMD php artisan serve --host=0.0.0.0
