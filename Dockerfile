# Stage 1: Composer dependencies
FROM composer:2.7.6 AS composer
WORKDIR /app
COPY composer.* ./
RUN composer install --no-scripts --no-interaction --prefer-dist --no-dev --ignore-platform-reqs

# Stage 2: Node.js dependencies and asset build
FROM node:22-alpine3.18 AS node
WORKDIR /app
COPY package.json ./
RUN npm install
COPY --from=composer /app/vendor ./vendor
COPY . .
RUN npm run build

# Stage 3: Final stage with PHP setup
FROM php:8.2-fpm

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y \
    libgcrypt20-dev \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    supervisor \
    && docker-php-ext-install \
    gd \
    intl \
    pdo_mysql \
    zip \
    exif \
    pcntl \
    && pecl install redis memcached \
    && docker-php-ext-enable redis memcached \
    && rm -rf /var/lib/apt/lists/*

# Set environment variables
ENV SERVER_NAME=dce-new.visionias.in
ENV WWWGROUP=1000

# Create and configure new user
RUN groupadd -g 1000 newusergroup && \
    useradd -u 1000 -g newusergroup -m newuser && \
    usermod -a -G www-data newuser

# Set up application directory and permissions
WORKDIR /var/www/html
COPY . .
COPY --from=node /app/public ./public
COPY --from=node /app/node_modules ./node_modules
COPY infrastructure/configuration/supervisor/*.conf /etc/supervisor/conf.d/
COPY infrastructure/configuration/php/php-production.ini "$PHP_INI_DIR/php.ini"

RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache && \
    chown -R newuser:newusergroup /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set executable permissions for scripts
RUN chmod +x /app/infrastructure/scripts/entrypoint.sh && \
    chmod +x /app/infrastructure/scripts/wait-for-it.sh

# Expose port and define entrypoint
EXPOSE 8000
ENTRYPOINT ["/app/infrastructure/scripts/entrypoint.sh"]
