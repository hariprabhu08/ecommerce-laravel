FROM php:7.4-fpm-alpine

ARG user
ARG uid

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

RUN adduser -D -h /home/$user -u $uid $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user
RUN chown -R www-data:www-data /var/www/vendor
RUN chmod -R 777 /var/www/vendor

USER $user

CMD php artisan serve --host=0.0.0.0
