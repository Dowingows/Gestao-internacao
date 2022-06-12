FROM php:8.1-apache

RUN apt-get update
RUN apt-get install -y libzip-dev
RUN apt-get update -y && apt-get install -y sendmail libpng-dev

RUN docker-php-ext-install zip
RUN docker-php-ext-install gd

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

COPY ./web ./

WORKDIR /var/www
COPY . ./
RUN rm -rf vendor/*
RUN composer update --profile
RUN a2enmod rewrite
RUN service apache2 restart

EXPOSE 80