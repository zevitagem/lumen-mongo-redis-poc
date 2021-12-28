#origin
FROM php:8.0-apache AS php8

#workdir
ENV APPPATH app
WORKDIR /var/www/html/$APPPATH

#copies
COPY . /var/www/html/$APPPATH

#tools
RUN apt-get -y update
RUN apt-get install -y \
        git \
        tree \
        vim \
        wget \
        subversion
RUN apt-get install -y \
        libzip-dev \
        zip
RUN apt-get install -y

RUN apt-get install -y \
        autoconf pkg-config libssl-dev

RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini

#extensions
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install zip

#commands
RUN rm -rf /var/cache/apk/*
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer