FROM php:8.4-cli

# Sistem paketlerini kur
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install bcmath gd pcntl pdo_mysql sockets zip

# Composer'ı al
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# --- STRATEJİK ADIM ---
# ÖNCE sadece composer dosyalarını kopyalıyoruz (Uygulama kodlarını DEĞİL)
COPY composer.json composer.lock ./

# Bağımlılıkları kur (Sınıfları aramadan sadece indirir)
RUN composer install --no-dev --no-interaction --no-autoloader --no-scripts

# ŞİMDİ tüm uygulama kodlarını içeri alıyoruz
COPY . .

# Autoload dosyasını kodlar içerideyken zorla oluşturuyoruz
RUN composer dump-autoload --optimize

# Yetkileri ver
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

# Başlatırken cache'leri temizleyerek başlat
CMD php artisan optimize:clear && php artisan serve --host 0.0.0.0 --port 8080