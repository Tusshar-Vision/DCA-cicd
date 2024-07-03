#!/bin/bash

# Wait for MySQL to become available
infrastructure/scripts/wait-for-it.sh 127.0.0.1:3306 -t 60

# Retry loop for connecting to MySQL
max_retries=5
retry_delay=10

for ((i=1; i<=max_retries; i++)); do
    php artisan migrate  # Replace with your actual application startup command
    if [ $? -eq 0 ]; then
        echo "Application startup successful."
        break
    else
        echo "Attempt $i: Application startup failed. Retrying in $retry_delay seconds..."
        sleep $retry_delay
    fi
done

# Ensure Laravel Debugbar is installed
if ! composer show barryvdh/laravel-debugbar --quiet; then
    composer require barryvdh/laravel-debugbar --dev
fi

# Clear and cache configurations to address Debugbar issues
php artisan optimize:clear
php artisan config:cache

# Run migrations
php artisan migrate --force

# Optimize and cache configurations
php artisan filament:clear-cached-components
php artisan event:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
php artisan filament:cache-components
php artisan scout:sync-index-settings

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
