FROM node:18 AS nodejs
FROM spiralscout/roadrunner:2.12.3 AS rr
FROM php:8.2-fpm-buster

RUN apt-get update  \
    && apt-get install -y \
    && apt-get install -y libcurl4-openssl-dev \
    && apt-get install -y zip unzip \
    && apt-get install -y libmagickwand-dev --no-install-recommends \
	&& docker-php-ext-install curl mysqli pdo_mysql sockets \
    && pecl install imagick \
    && docker-php-ext-enable imagick

COPY --from=rr /usr/bin/rr /usr/local/bin/rr

RUN chmod +x /usr/local/bin/rr

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --from=nodejs /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=nodejs /usr/local/bin/node /usr/local/bin/node

RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

RUN npm i -g --save-dev chokidar

WORKDIR /app

CMD composer install \
    && php artisan key:generate --ansi \
    && php artisan storage:link \
    && php artisan migrate \
    && php artisan octane:install --server=roadrunner \
    && php artisan octane:start --host=0.0.0.0 --watch
