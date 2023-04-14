FROM php:8.2-fpm

MAINTAINER Ikaro C. Laborda <iclaborda@msn.com>

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/appparking-api

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY --chmod=755 entrypoint.sh /usr/local/bin/

ENTRYPOINT ["entrypoint.sh"]
