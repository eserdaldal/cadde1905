FROM php:8.4-cli

# Sistem paketlerini kur
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install bcmath gd pcntl pdo_mysql sockets zip

# Composer'ı al
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Tüm dosyaları kopyala
COPY . .

# --- KRİTİK YETKİ GÜNCELLEMESİ ---
# Sunucunun bu klasörlere dokunabilmesi şart
RUN chmod -R 777 storage bootstrap/cache

# Bağımlılıkları kur
RUN composer install --no-dev --no-interaction --optimize-autoloader --ignore-platform-reqs

EXPOSE 8080

# Logları dosyaya değil, doğrudan ekrana (stdout) basmasını sağlayan ayar ekledik
CMD php artisan config:clear && \
    export LOG_CHANNEL=errorlog && \
    php artisan serve --host 0.0.0.0 --port 8080