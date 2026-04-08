FROM php:8.2-cli

# Gerekli sistem paketlerini ve PHP eklentilerini kur
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install bcmath gd pcntl pdo_mysql sockets zip

# Composer'ı kopyala
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Çalışma dizini
WORKDIR /app
COPY . /app

# Bağımlılıkları kur
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]