<center>
<img src="logo.png">
<h4>A <i>Tippspiel</i> that you can bet on
</center>

> This is a betting game for soccer which can use every tournament that openLigaDB offers. The current game is not yet changable in the compose file, but you can mody the code an build the container yourself! (See below for more information)

> Be aware, that the whole interface is currently only available in german. Pull Requests are very welcome to fix that :)

**Current Default Match**: UEFA Women's Champion Ship 2025

## Installation (using Docker)
### using Docker Compose
```yaml
services:
  opentipp:
    restart: unless-stopped
    image: ghcr.io/mattipunkt/opentipp-reborn:latest
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

### Change tournament
Go to [openLigaDB](https://openligadb.de) and select the tournament you want to bet on. Copy the part after the "/". 
In the project files open `routes/console.php` and change the `$url`-Variable to your requirements.