FROM php:8.4-cli

# Sistem paketlerini kur
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install bcmath gd pcntl pdo_mysql sockets zip

# Composer'ı al
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Sadece composer dosyalarını kopyala
COPY composer.json composer.lock ./

# --- KRİTİK DEĞİŞİKLİK ---
# "install" yerine "update" komutunu kullanarak Lock dosyasını sunucuda zorla yeniliyoruz
RUN composer update --no-dev --no-interaction --no-autoloader --no-scripts --ignore-platform-reqs

# Şimdi uygulama kodlarını içeri al
COPY . .

# Autoload oluştur
RUN composer dump-autoload --optimize

# Yetkileri ver
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

# Başlatırken cache temizliği
CMD php artisan config:clear && php artisan route:clear && php artisan serve --host 0.0.0.0 --port 8080