#!/bin/sh

php artisan key:generate
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
chmod +x entrypoint.sh
