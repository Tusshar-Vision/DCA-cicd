# Stage 1: Composer dependencies
FROM composer:2.7.6 AS composer
# Set the working directory
WORKDIR /app

COPY composer.* ./

RUN composer install --no-scripts --no-interaction --prefer-dist --no-dev --ignore-platform-reqs

# Stage 2: Node.js dependencies and asset build
FROM node:22-alpine3.18 AS node

WORKDIR /app

COPY package.json ./

RUN npm install

# Copy the required preset files
COPY --from=composer /app/vendor/filament ./vendor/filament

COPY . .

RUN npm run build

# Stage 3: Final stage with combined application
FROM dunglas/frankenphp

RUN install-php-extensions pcntl memcached redis pdo_mysql intl zip gd exif @composer-2.7.6

RUN apt update
RUN apt install supervisor -y
# Copy the application code from the composer and node stages
COPY --from=node /app .
COPY infrastructure/configuration/supervisor/*.conf /etc/supervisor/conf.d/

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set executable permissions
RUN chmod +x /app/infrastructure/scripts/entrypoint.sh
RUN chmod +x /app/infrastructure/scripts/wait-for-it.sh
