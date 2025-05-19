# OpenTipp
## About
TBC

## Installation (using Docker)
### using Docker Compose
```yaml
services:
  opentipp:
    restart: unless-stopped
    image: mukkematti/opentipp:latest
    volumes:
      - opentipp_db:/app/db
    ports:
      - "8080:80" # change this to whatever you want
    environment:
      - APP_URL=https://mydomain.com # your domain at which the app will be reached (with http/https)
      - SESSION_DOMAIN=mydomain.com # this should be the same as APP_URL, but without http/https
      - PROXY_URL=https://mydomain.com # (optional) if you use a reverse proxy, put the url here
      - PROXY_SCHEMA=https # (optional) if you use a reverse proxy, put the protocol here
      - MAIL_MAILER=smtp # write this if you want mail and fill out the other mail-variables
      - MAIL_HOST=mail.example.com # smtp server name
      - MAIL_PORT=587 # smtp port
      - MAIL_USERNAME=user@example.com # smtp credetials
      - MAIL_PASSWORD=password123 # stmp credentials
      - MAIL_FROM_ADDRESS=opentipp@example.com # put the mail adress here, which will be shown as sent-adress

volumes:
  opentipp_db:

```

I really recommend using a Docker Volume for the db. Otherwise you will get permission problems.

## Development
**on \*nix-Systems**

Install PHP from [php.new](https://php.new) and NodeJS.
```sh
git clone https://github.com/mattipunkt/openTipp-reborn
cd openTipp-reborn
npm install
composer install
cp .env.example .env
php artisan key:generate
```
