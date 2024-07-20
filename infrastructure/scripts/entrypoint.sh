#!/bin/bash

# Wait for MySQL to become available
infrastructure/scripts/wait-for-it.sh 52.27.93.118:3306 -t 60

# Clear and cache configurations to address Debugbar issues
php artisan optimize:clear
php artisan config:cache

# Run migrations
# php artisan migrate:rollback
php artisan migrate --force


# Optimize and cache configurations
php artisan filament:clear-cached-components
php artisan event:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
php artisan filament:cache-components
php artisan scout:sync-index-settings

if [ "$NODE_ENV" = "development" ]; then
    npm run dev &
fi

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
