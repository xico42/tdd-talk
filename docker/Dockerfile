FROM php:8.1-fpm AS base
WORKDIR /application

ARG RDKAFKA_VERSION="2.4.0"
ARG RDKAFKA_PECL_VERSION="5.0.2"

RUN apt-get update \
    && apt-get -y install git libzip-dev libxml2-dev unzip libpq-dev \
    && docker-php-ext-install zip soap bcmath pgsql pdo_pgsql pdo_mysql

RUN mkdir -p /tmp/librdkafka \
    && cd /tmp \
    && curl -L https://github.com/edenhill/librdkafka/archive/v${RDKAFKA_VERSION}.tar.gz | tar xz -C /tmp/librdkafka --strip-components=1 \
    && cd librdkafka \
    && ./configure \
    && make \
    && make install \
    && pecl install rdkafka-${RDKAFKA_PECL_VERSION} \
    && docker-php-ext-enable rdkafka \
    && rm -rf /tmp/librdkafka

COPY docker/php-ini-overrides.ini /usr/local/etc/php/conf.d/99-overrides.ini
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/docker.conf

FROM base AS dev
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && apt-get update --allow-releaseinfo-change && apt-get install -y redis-tools
RUN pecl install xdebug && docker-php-ext-enable xdebug

FROM dev AS builder
ARG COMPOSER_AUTH
WORKDIR /application
COPY composer.json composer.lock ./
RUN composer install -o --no-dev --no-scripts

FROM base AS prod
COPY . /application
COPY --from=builder /application/vendor /application/vendor
