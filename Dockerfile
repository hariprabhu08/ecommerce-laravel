FROM php:7.4-fpm-alpine

COPY . /var/www

RUN docker-php-ext-install pdo pdo_mysql

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN alias composer='php /usr/bin/composer'


WORKDIR /var/www

RUN composer install

COPY php.ini /usr/local/etc/php/php.ini

CMD php artisan serve --host=0.0.0.0
