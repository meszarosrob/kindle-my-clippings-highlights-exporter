FROM php:8.1-cli

RUN apt-get update && apt-get install -y git zip unzip curl

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/

RUN pecl install xdebug && docker-php-ext-enable xdebug
