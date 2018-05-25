FROM phusion/baseimage:0.10.1

LABEL maintainer="nick@foobar.net.nz"

RUN apt-get update -qqy \
    && DEBIAN_FRONTEND=noninteractive apt-get install -qqy \
    php-fpm \
    php-curl \
    php-gd \
    php-http \
    php-imagick \
    php-json \
    php-log \
    php-mbstring \
    php-memcache \
    php-mysql \
    php-mysqli \
    php-oauth \
    && apt-get clean -qqy

# Configure a service entry for Apache
COPY run /etc/service/php-fpm/run

COPY www.conf /etc/php/7.0/fpm/pool.d/

# Enable for FPM
RUN phpenmod curl gd imagick json memcache mysqli oauth opcache

ENV DOCROOT=/var/www

# Test the Configuration
RUN mkdir $DOCROOT && /etc/service/php-fpm/run -t 2>&1 && rm -rf $DOCROOT

EXPOSE 9000
