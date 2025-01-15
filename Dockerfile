FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./public /var/www/html

RUN chown -R www-data:www-data /var/www/html

RUN a2enmod rewrite
