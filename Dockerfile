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
COPY --from=composer /app/vendor ./vendor
COPY . .
RUN npm run build
# Stage 3: Final stage with combined application
FROM dunglas/frankenphp
ENV FRANKENPHP_NO_TLS=1
ENV SERVER_NAME=dce-new.visionias.in
RUN apt update
RUN apt install libgcrypt20-dev supervisor -y
RUN install-php-extensions pcntl memcached redis pdo_mysql intl zip gd exif http @composer-2.7.6
# Copy the application code from the composer and node stages
COPY . .
COPY --from=node /app/public ./public
COPY --from=node /app/node_modules ./node_modules
# Copy configuration files
COPY infrastructure/configuration/supervisor/*.conf /etc/supervisor/conf.d/
COPY infrastructure/configuration/php/php-production.ini "$PHP_INI_DIR/php.ini"
RUN composer install --no-interaction --prefer-dist --optimize-autoloader
# Set executable permissions
RUN chmod +x /app/infrastructure/scripts/entrypoint.sh
RUN chmod +x /app/infrastructure/scripts/wait-for-it.sh
