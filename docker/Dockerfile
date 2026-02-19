FROM php:8.3-fpm-alpine

# System deps
RUN apk add --no-cache \
        bash \
        git \
        curl \
        unzip \
        icu-dev \
        oniguruma-dev \
        libzip-dev \
        mysql-client \
        postgresql-client \
        autoconf \
        g++ \
        make

# PHP extensions
RUN docker-php-ext-install \
        pdo \
        pdo_mysql \
        intl \
        mbstring \
        zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy code
COPY . .

# Install deps (prod-safe by default; override in dev if you want)
RUN composer install --no-interaction --no-progress --prefer-dist || true

# Permissions (storage / cache)
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
