FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY ./public /var/www/html

RUN chown -R www-data:www-data /var/www/html

RUN a2enmod rewrite
