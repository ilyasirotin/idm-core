FROM php:8.4.7-fpm-alpine3.20

ENV MUSL_LOCPATH /usr/share/i18n/locales/musl

RUN apk add --no-cache \
        bash \
        icu-dev \
        libzip-dev \
        postgresql-dev \
        libsodium-dev \
        $PHPIZE_DEPS \
    && docker-php-ext-install -j$(nproc) \
        zip \
        pdo \
        pdo_pgsql \
        intl \
        sodium \
        opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del --no-cache $PHPIZE_DEPS

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

COPY ./php-fpm/conf.d /usr/local/etc/php/conf.d

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer

RUN addgroup -g 1000 dev && adduser -u 1000 -G dev -s /bin/sh -D dev

WORKDIR /app
USER dev
