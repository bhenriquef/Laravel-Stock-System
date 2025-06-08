FROM php:8.2-fpm

# Instala extensões e dependências
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim unzip git curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && pecl install redis \
    && docker-php-ext-enable redis

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Gera chave do app
RUN php artisan key:generate

RUN php artisan config:cache

# (Opcional) Executa migrations
# RUN php artisan migrate --force

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000