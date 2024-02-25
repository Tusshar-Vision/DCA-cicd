#!/bin/bash
# Setting Up ssh for pulling code from repository
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/github
# bun
#export BUN_INSTALL="$HOME/.bun"
#export PATH=$BUN_INSTALL/bin:$PATH
## Node Setup
#export NVM_DIR="$HOME/.nvm"
#[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"  # This loads nvm
## Navigate to the Laravel project directory
cd /var/www/html/vision-ca-api/
# Pull the latest changes from the GitHub repository
git pull origin main
# Install/update dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
bun install
bun run build
# Run database migrations
php artisan migrate --force
# Clear caches
php artisan optimize:clear
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
