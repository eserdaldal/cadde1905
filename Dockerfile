# Laravel 12, PHP 8.2 veya 8.3 gerektirir. 
# Bu imaj hem PHP'yi hem de gerekli araçları içerir.
FROM php:8.2-cli

# Gerekli sistem paketlerini kur
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

# Composer'ı kopyala
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Çalışma dizini
WORKDIR /app
COPY . /app

# Laravel bağımlılıklarını kur
RUN composer install --no-dev --optimize-autoloader

# Render'ın beklediği portu ayarla
EXPOSE 8080

# Uygulamayı başlat
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]