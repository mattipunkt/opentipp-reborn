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
      - opentipp:/var/www/html/storage/app
    ports:
      - "8080:80" # change this to whatever you want
    environment:
      - DB_USERNAME=opentipp # this should be the same as POSTGRES_USER in db container
      - DB_PASSWORD=opentipp # this should be the same as POSTGRES_PASSWORD in db container
      - APP_URL=https://mydomain.com # your domain at which the app will be reached (with http/https)
      - SESSION_DOMAIN=mydomain.com # this should be the same as APP_URL, but without http/https
      - PROXY_URL=https://mydomain.com # (optional) if you use a reverse proxy, put the url here
      - PROXY_SCHEMA=https # (optional) if you use a reverse proxy, put the protocol here
    depends_on:
      db:
        condition: service_healthy
  db:
    restart: unless-stopped
    image: postgres:latest
    shm_size: 128mb
    environment:
      - POSTGRES_PASSWORD=opentipp
      - POSTGRES_USER=opentipp
      - POSTGRES_DB=opentipp # DO NOT CHANGE THIS
      - PGDATA=/var/lib/postgresql/data/pgdata
    volumes:
      - opentipp_db:/var/lib/postgresql/data
    healthcheck:
      test: ["CMD-SHELL", "pg_isready -U opentipp"]
      interval: 5s
      timeout: 5s
      retries: 5

volumes:
  opentipp:
  opentipp_db:
```



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
