FROM php:8.1-fpm

RUN apt-get update && \
                    DEBIAN_FRONTEND=noninteractive apt-get install -y \
    libzip-dev \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libbz2-dev \
    libonig-dev \
    optipng \
    pngquant \
    exiftool

RUN docker-php-ext-install mbstring \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install exif \
    && docker-php-ext-enable exif \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable gd \