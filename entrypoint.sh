#!/bin/sh

cp .env.deploy .env
echo "DB_USERNAME=$DB_USERNAME" >> .env
echo "DB_PASSWORD=$DB_PASSWORD" >> .env
echo "APP_URL=$APP_URL" >> .env # e.g. https://mydomain.com
echo "SESSION_DOMAIN"="$SESSION_DOMAIN" >> .env  # e.g mydomain.com

php artisan key:generate

php artisan migrate --no-interaction
php artisan oldb
crond && nginx && php-fpm