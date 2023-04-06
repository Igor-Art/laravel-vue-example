FROM node:18 AS nodejs
FROM php:8.2-fpm-buster

RUN apt-get update  \
    && apt-get install -y \
    && apt-get install -y libcurl4-openssl-dev \
    && apt-get install -y zip unzip \
	&& docker-php-ext-install curl mysqli pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --from=nodejs /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=nodejs /usr/local/bin/node /usr/local/bin/node

RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

RUN npm i -g --save-dev chokidar

WORKDIR /app
