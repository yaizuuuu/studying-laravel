FROM php:7.1-fpm

RUN apt-get update \
 && apt-get install -y \
        git \
        unzip \
        libz-dev \
        aptitude \
        libpng-tools \
        mysql-client \
        libmcrypt-dev \
        libmemcached-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
 && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install -j$(nproc) gd iconv mcrypt pdo_mysql zip \
 && pecl install xdebug-2.5.5 \
 && pecl install memcached \
 && echo extension=memcached.so >> /usr/local/etc/php/conf.d/memcached.ini

# install composer
RUN cd '/' \
 && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');" \
 && mv composer.phar /usr/local/bin/composer \
 && useradd -m -s /bin/bash nginx

# install node & npm 
RUN apt-get install -y curl wget gnupg \
 && curl -sL https://deb.nodesource.com/setup_10.x | bash -- \
 && apt-get install -y nodejs \
 && npm update -g npm \
 && npm i -g n \
 && n lts \
 && apt-get purge -y nodejs

WORKDIR /opt

