FROM php:8.4-cli

# Gerekli sistem paketlerini kur
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install bcmath gd pcntl pdo_mysql sockets zip

# Composer'ı kopyala
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

# Paketleri kur ve autoload dosyasını zorla oluştur
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Laravel'in eski cache dosyalarını temizle
RUN php artisan optimize:clear

# Yetkileri düzenle
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

# Başlatırken cache'i tekrar temizleyip başlatıyoruz
CMD php artisan optimize:clear && php artisan serve --host 0.0.0.0 --port 8080