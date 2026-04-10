FROM php:8.4-fpm-alpine

# Gerekli sistem paketlerini kur
RUN apk add --no-cache \
    zip unzip git curl libpng-dev libzip-dev oniguruma-dev \
    icu-dev mysql-client

# PHP uzantılarını kur
RUN docker-php-ext-install bcmath gd pdo_mysql zip intl

# Composer'ı al
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Dosyaları kopyala
COPY . .

# Yetkileri düzenle
RUN chmod -R 775 storage bootstrap/cache

# Bağımlılıkları yükle
RUN composer install --no-dev --optimize-autoloader --no-interaction

EXPOSE 8080

# Başlatma komutu (DigitalOcean otomatik olarak APP_KEY vb. yönetebilir)
CMD php artisan migrate --force && php artisan optimize:clear && php artisan serve --host 0.0.0.0 --port 8080