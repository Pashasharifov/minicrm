FROM php:8.4-fpm

# Composer üçün lazım olan dependensiyalar
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Composer quraşdır
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Laravel kodlarını konteynerə kopyala
WORKDIR /var/www/html
COPY . .

# Vendor quraşdır
RUN composer install --no-dev --optimize-autoloader

# Laravel permission düzəlişi
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["php-fpm"]
