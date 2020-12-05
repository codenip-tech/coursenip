FROM php:7.4.6 AS assets

RUN apt-get update \
    && apt-get install -y git zip zlib1g-dev libzip-dev \
    && docker-php-ext-install zip

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer
RUN composer self-update

RUN composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --optimize-autoloader --classmap-authoritative \
	&& composer clear-cache

WORKDIR /app

ENV APP_ENV prod
COPY api/composer.* ./
RUN composer install --no-dev
COPY api/ ./
RUN bin/console assets:install

FROM nginx:1.19

RUN adduser --disabled-password --gecos "" appuser
COPY /api/docker/nginx/default.prod.conf /etc/nginx/conf.d/default.conf
COPY --from=assets /app/public/ /appdata/www/public/