FROM php:7.4.6-fpm

COPY /mailer/docker/php/php.ini /usr/local/etc/php/php.ini

RUN apt-get update \
    && apt-get install -y git acl openssl openssh-client wget zip vim librabbitmq-dev libssh-dev \
    && apt-get install -y libpng-dev zlib1g-dev libzip-dev libxml2-dev libicu-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip gd soap bcmath sockets \
    && pecl install amqp \
    && docker-php-ext-enable --ini-name 05-opcache.ini opcache amqp

RUN curl --insecure https://getcomposer.org/composer-1.phar -o /usr/bin/composer && chmod +x /usr/bin/composer
RUN composer self-update

RUN composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --optimize-autoloader --classmap-authoritative \
	&& composer clear-cache

WORKDIR /appdata/www

ENV APP_ENV prod
COPY mailer/composer.* ./
RUN composer install --no-dev --no-scripts
COPY mailer/ ./
RUN composer run post-install-cmd
RUN rm -rf var/*
RUN chown www-data: var

CMD bin/console messenger:consume amqp_user