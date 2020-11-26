FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        zlib1g-dev \
        libpng-dev \
        libpq-dev \
        libzip-dev \
        curl \
        wget \
        zip \
        unzip \
        git \
	nodejs \
	npm
RUN docker-php-ext-install pdo pdo_mysql gd zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER root

RUN usermod -u 1000 www-data

WORKDIR /var/www/

CMD ["php-fpm"]
