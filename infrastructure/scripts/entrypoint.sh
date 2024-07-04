#!/bin/bash

# Wait for MySQL to be ready
/app/infrastructure/scripts/wait-for-it.sh db:3306 --timeout=60 --strict -- echo "MySQL is up"

# Run migrations
php artisan migrate --force

# Optimize and cache configurations
php artisan optimize:clear
php artisan filament:clear-cached-components
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
php artisan filament:cache-components
php artisan data:cache-structures
php artisan scout:sync-index-settings
php artisan sitemap:generate

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
