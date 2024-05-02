#!/bin/bash

# Script to Setup SSH for Pulling Code with Option Flags for Branch and SSH Key

# Default values
BRANCH_NAME="main"
SSH_KEY_NAME="github"

# Parse option flags using getopts
while getopts "b:k:" opt; do
  case $opt in
    b) BRANCH_NAME=$OPTARG ;;
    k) SSH_KEY_NAME=$OPTARG ;;
    \?) echo "Invalid option -$OPTARG" >&2
        exit 1
        ;;
  esac
done

# Setup SSH agent and add the specified SSH key
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/${SSH_KEY_NAME}

# Optional setup for bun and Node can go here

# Navigate to the project directory
cd /var/www/html/vision-ca-api/

# Pull the latest changes from the specified branch
git pull origin ${BRANCH_NAME}

# Install/update dependencies using Composer and Bun
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
bun install
bun run build

# Run database migrations and clear caches
php artisan migrate --force
php artisan optimize:clear
php artisan filament:clear-cached-components

php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
php artisan filament:cache-components

sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl restart all
