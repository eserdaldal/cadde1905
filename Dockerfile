FROM bitnami/laravel:12

COPY . /app
WORKDIR /app

RUN composer install --no-dev

CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]