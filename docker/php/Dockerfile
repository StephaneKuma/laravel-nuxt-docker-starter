# Base image
FROM php:8.3

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Starting from scratch
RUN apt-get clean
RUN apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Dependencies
RUN apt-get update

# Zip
RUN apt-get install -y libzip-dev zip &&\
    docker-php-ext-configure zip &&\
    docker-php-ext-install zip

# Git
RUN apt-get install -y git

# Curl
RUN apt-get install -y libcurl3-dev curl &&\
    docker-php-ext-install curl

# GD
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev
RUN docker-php-ext-configure gd
RUN docker-php-ext-install gd

# ImageMagick
RUN apt-get install -y imagemagick &&\
    apt-get install -y --no-install-recommends libmagickwand-dev
RUN pecl install imagick &&\
    docker-php-ext-enable imagick

# PostgreSQL
RUN apt-get install -y libpq-dev &&\
    docker-php-ext-install pdo pdo_pgsql

# BC Math
RUN docker-php-ext-install bcmath

# Human Language and Character Encoding Support
RUN apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# PHP Redis extension
RUN pecl install redis
RUN docker-php-ext-enable redis

# Custom php.ini config
COPY php.ini /usr/local/etc/php/php.ini

# Install Xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Clean up
RUN apt-get clean
RUN apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Set up default directory
WORKDIR /var/www/api

# Copier le script entrypoint dans l'image
COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh

# Donner les permissions d'exécution
RUN chmod +x /usr/local/bin/entrypoint.sh

# Définir l'entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Switch to non-root user
USER $user
