#!/usr/bin/env bash

chmod 777 -R /var/www/html 
#php artisan key:generate --force
php artisan cache:clear
php artisan config:clear
#php artisan storage:link
service nginx start
php-fpm
