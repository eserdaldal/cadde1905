FROM php:8.2-cli

# Gerekli sistem paketlerini kur
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install bcmath gd pcntl pdo_mysql sockets zip

# Composer'ı kopyala
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

# Filament ve Laravel paketlerini temizce kur (ignore-platform-reqs'i kaldırdık)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Laravel dosyalarının yetkilerini düzenle (Render/Linux için önemli)
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]