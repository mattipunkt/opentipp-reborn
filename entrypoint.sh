#!/bin/sh
cd /var/www/html

cp .env.deploy .env
echo "DB_USERNAME=$DB_USERNAME" >> .env
echo "DB_PASSWORD=$DB_PASSWORD" >> .env
echo "APP_URL=$APP_URL" >> .env # e.g. https://mydomain.com
echo "SESSION_DOMAIN=$SESSION_DOMAIN" >> .env  # e.g mydomain.com
echo "PROXY_URL=$PROXY_URL" >> .env


php artisan key:generate
php artisan optimize:clear
php artisan optimize

php artisan migrate --no-interaction --force
php artisan oldb
crond && nginx && php-fpm