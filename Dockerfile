FROM php:8.1-fpm-alpine3.15

RUN apk --update add autoconf shadow gcc libc-dev make postgresql-dev git libzip-dev libxml2-dev jq rabbitmq-c-dev librdkafka-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/include/postgresql/ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pgsql pdo_pgsql intl sockets zip \
    && docker-php-ext-enable opcache \
    && rm -rf /var/cache/apk/* && rm -rf /etc/apk/cache

RUN apk add --update linux-headers

RUN pecl install pcov xdebug rdkafka amqp && docker-php-ext-enable pcov xdebug rdkafka amqp \
    && echo "xdebug.mode=debug,coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=172.17.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    #&& echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=false" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN curl -L https://getcomposer.org/composer-stable.phar -o /usr/bin/composer && chmod a+x /usr/bin/composer

RUN docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl