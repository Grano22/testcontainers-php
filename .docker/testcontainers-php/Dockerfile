FROM php:8.2.25-cli-alpine AS php-base

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

FROM docker:27.3.1-dind AS testcontainers-php

#ENV PHP_VERSION=8.1

#RUN apk add --update --no-cache \
#    php${PHP_VERSION} \
#    curl \
#    git \
#    unzip

COPY --from=php-base /usr/local/bin /usr/local/bin
COPY --from=php-base /usr/local/lib /usr/local/lib
COPY --from=php-base /usr/bin/composer /usr/bin/composer

WORKDIR /app

FROM testcontainers-php AS testcontainers-php-prod

COPY . /app

RUN composer install --no-dev --optimize-autoloader