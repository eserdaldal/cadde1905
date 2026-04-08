FROM php:8.3-fpm-alpine

WORKDIR /var/www

RUN apk add --no-cache \
    bash \
    git \
    unzip \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    $PHPIZE_DEPS \
 && docker-php-ext-install \
    intl \
    pdo_mysql \
    zip \
 && apk del $PHPIZE_DEPS

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . /var/www

RUN mkdir -p storage bootstrap/cache