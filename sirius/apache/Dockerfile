FROM php:7.2.6-apache

RUN apt-get update 

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN a2enmod rewrite \
    && service apache2 restart

COPY ./src /var/www/html/
