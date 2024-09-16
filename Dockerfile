FROM composer:2.7.6 AS composer
WORKDIR /app
COPY composer.* ./
RUN composer install --no-scripts --no-interaction --prefer-dist --no-dev --ignore-platform-reqs

FROM node:22-alpine3.18 AS node
WORKDIR /app
COPY package.json ./
RUN npm install
COPY --from=composer /app/vendor ./vendor
COPY . .
RUN npm run build

FROM dunglas/frankenphp

ENV SERVER_NAME=dce-new.visionias.in

ENV WWWGROUP=1000

RUN apt-get update && apt-get install -y \
    apt-utils \
    supervisor \
    && install-php-extensions pcntl memcached redis pdo_mysql intl zip gd exif @composer-2.7.6 \
    && rm -rf /var/lib/apt/lists/*

RUN groupadd -g 1000 newusergroup && \
    useradd -u 1000 -g newusergroup -m newuser

RUN usermod -a -G www-data newuser

COPY . .
COPY --from=node /app/public ./public
COPY --from=node /app/node_modules ./node_modules
COPY infrastructure/configuration/supervisor/*.conf /etc/supervisor/conf.d/
COPY infrastructure/configuration/php/php-production.ini "$PHP_INI_DIR/php.ini"

RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache

RUN chown -R newuser:newusergroup /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chmod +x /app/infrastructure/scripts/entrypoint.sh
RUN chmod +x /app/infrastructure/scripts/wait-for-it.sh

EXPOSE 8000

ENTRYPOINT ["/app/infrastructure/scripts/entrypoint.sh"]

