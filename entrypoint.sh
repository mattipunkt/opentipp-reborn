#!/bin/sh
cd /var/www/html

cp .env.deploy .env

echo "APP_URL=$APP_URL" >> .env # e.g. https://mydomain.com
echo "SESSION_DOMAIN=$SESSION_DOMAIN" >> .env  # e.g mydomain.com
echo "PROXY_URL=$PROXY_URL" >> .env
echo "MAIL_MAILER=$MAIL_MAILER" >> .env
echo "MAIL_HOST=$MAIL_HOST" >> .env
echo "MAIL_PORT=$MAIL_PORT" >> .env
echo "MAIL_USERNAME=$MAIL_USERNAME" >> .env
echo "MAIL_PASSWORD=$MAIL_PASSWORD" >> .env
echo "MAIL_FROM_ADDRESS=$MAIL_FROM_ADDRESS" >> .env

php artisan key:generate
php artisan optimize:clear
php artisan optimize

php artisan migrate --no-interaction --force
php artisan oldb
crond && nginx && php-fpm
