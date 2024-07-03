#!/bin/bash

php artisan key:generate
sudo chmod 664 .env
sudo chmod -R 775 bootstrap/cache
sudo chown -R thakur:www-data bootstrap/cache
sudo chown -R thakur:www-data storage/framework/cache/data/
sudo chown -R thakur:www-data storage/framework/views/
sudo chown -R thakur:thakur /home/thakur/vision-ca-api-main/vendor
chmod -R u+w /home/thakur/vision-ca-api-main/public/js/filament/forms/components/
sudo chown -R thakur:thakur /home/thakur/vision-ca-api-main/public/js/filament/forms/components/
sudo chmod -R 775 /home/thakur/vision-ca-api-main/public/js/
sudo chown -R thakur:thakur /home/thakur/vision-ca-api-main/public/js/
sudo chmod -R 775 /home/thakur/vision-ca-api-main/public/css/
sudo chown -R thakur:thakur /home/thakur/vision-ca-api-main/public/css/
sudo apt-get install php-mysql
sudo apt-get install php-pdo php-mysql
sudo service apache2 restart
sudo service php8.2-fpm restart
php artisan make:migration ca-visionias
sudo chmod -R 775 database/migrations
sudo chown -R $USER:$USER /home/thakur/vision-ca-api-main
php artisan make:migration ca-visionias
php artisan migrate
php artisan serve
npm install
npm run dev
