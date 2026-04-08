FROM php:8.4-cli

# Sistem paketlerini kur
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install bcmath gd pcntl pdo_mysql sockets zip

# Composer'ı al
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Tüm dosyaları içeri al
COPY . .

# Yetkileri ver
RUN chmod -R 777 storage bootstrap/cache

# KRİTİK: SQLite veritabanı dosyasının var olduğundan emin ol
RUN mkdir -p database && touch database/database.sqlite && chmod 777 database/database.sqlite

# Bağımlılıkları kur
RUN composer update --no-dev --no-interaction --optimize-autoloader --ignore-platform-reqs

EXPOSE 8080

# Başlatırken veritabanını hazırla (migrate) ve sistemi aç
CMD php artisan migrate --force && \
    php artisan optimize:clear && \
    export LOG_CHANNEL=errorlog && \
    php artisan serve --host 0.0.0.0 --port 8080