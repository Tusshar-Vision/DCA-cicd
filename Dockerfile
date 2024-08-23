# Stage 1: Composer dependencies (minimal base image)
FROM alpine:3.18 AS composer

WORKDIR /app

COPY composer.json ./
COPY composer.lock ./  # Include composer.lock for faster builds

RUN apk add --no-cache php8.1-cli \
    php8.1-extensions[gd,exif,http,intl,zip] \
    composer

RUN composer install --no-dev --optimize-autoloader

# Stage 2: Node.js dependencies and asset build
FROM node:22-alpine3.18 AS node

WORKDIR /app

COPY package.json ./
COPY --from=composer /app/vendor ./vendor

RUN npm install 

COPY . .

RUN npm run build

# Stage 3: Final stage (multi-stage build)
FROM dunglas/frankenphp-alpine AS final

# Skip unnecessary package updates and install supervisor
RUN apk add --no-cache supervisor

# Install PHP extensions (leverage existing composer dependencies)
COPY --from=composer /app/vendor/bin/php /usr/local/bin/php

# Copy application code and assets (combine from previous stages)
COPY --from=composer /app .
COPY --from=node /app/public ./public
COPY --from=node /app/node_modules ./node_modules

# Copy configuration files
COPY infrastructure/configuration/supervisor/*.conf /etc/supervisor/conf.d/
COPY infrastructure/configuration/php/php-production.ini "$PHP_INI_DIR/php.ini"

# Set executable permissions (combine in one RUN)
RUN chmod +x /app/infrastructure/scripts/*.sh
